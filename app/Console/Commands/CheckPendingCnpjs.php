<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cnpj;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CheckPendingCnpjs extends Command
{
    protected $signature = 'check:pending-cnpjs';
    protected $description = 'Check for pending CNPJs and update their status';

    protected static $lastExecutionTime;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $pendingCnpjs = Cnpj::where('status', 'pendente')->get();
        $total = $pendingCnpjs->count();

        if ($total > 0) {
            foreach ($pendingCnpjs as $cnpj) {
                $this->checkCnpjStatus($cnpj);

                // Atualizar o tempo da última execução
                self::$lastExecutionTime = time();

                // Pausa de 1 minuto entre consultas de CNPJs diferentes
                if (self::$lastExecutionTime) {
                    $elapsedTime = time() - self::$lastExecutionTime;
                    if ($elapsedTime < 30) {
                        sleep(30 - $elapsedTime);
                    }
                }
            }

            $this->info("Successfully checked and updated status for {$total} pending CNPJs.");
        } else {
            $this->info('No pending CNPJs found.');
        }

        return 0;
    }

    private function checkCnpjStatus(Cnpj $cnpj)
    {
        $client = new Client();
        $cnpjNumber = $cnpj->cnpj;

        // Verifica se o CNPJ possui 14 dígitos, se não, adiciona um zero no início
        if (strlen($cnpjNumber) < 14) {
            $cnpjNumber = str_pad($cnpjNumber, 14, '0', STR_PAD_LEFT);
        }

        $url = 'https://receitaws.com.br/v1/cnpj/' . $cnpjNumber;

        try {
            // Fazer a requisição
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['status']) && $data['status'] !== 'ERROR') {
                $this->approveOrRejectCnpj($cnpj, $data);
            } else {
                Log::error('Error fetching CNPJ status for CNPJ: ' . $cnpjNumber);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching CNPJ status: ' . $e->getMessage());
        }
    }

    private function approveOrRejectCnpj(Cnpj $cnpj, array $data)
    {
        // Verifica se a chave 'atividade_principal' existe e não está vazia
        if (!isset($data['atividade_principal'][0]['code'])) {
            Log::error('atividade_principal not found for CNPJ: ' . $cnpj->cnpj);
            $cnpj->status = 'reprovado';
            $cnpj->save();
            return;
        }

        // Verifica o código da atividade principal
        $atividadePrincipal = $data['atividade_principal'][0]['code'];
        if (in_array($atividadePrincipal, ['64.63-8-00', '64.62-0-00'])) {
            $cnpj->status = 'reprovado';
            $cnpj->save();
            return;
        }

        $situacaoEspecial = $data['situacao_especial'];
        if($situacaoEspecial === 'RECUPERACAO JUDICIAL'){
            $cnpj->status = 'reprovado';
            $cnpj->save();
            return;
        }

        // Verifica os sócios no QSA
        if (isset($data['qsa'])) {
            foreach ($data['qsa'] as $socio) {
                if (stripos($socio['qual'], 'empresa') !== false || stripos($socio['qual'], 'S/A') !== false || stripos($socio['qual'], 'LTDA') !== false) {
                    $cnpj->status = 'reprovado';
                    $cnpj->save();
                    return;
                }

                if (stripos($socio['nome'], 'estrangeiro') !== false) {
                    $cnpj->status = 'reprovado';
                    $cnpj->save();
                    return;
                }

                if (isset($socio['nome_rep_legal']) && !empty($socio['nome_rep_legal'])) {
                    $cnpj->status = 'reprovado';
                    $cnpj->save();
                    return;
                }
            }
        } else {
            Log::error('qsa not found for CNPJ: ' . $cnpj->cnpj);
            $cnpj->status = 'reprovado';
            $cnpj->save();
            return;
        }

        // Se passar em todas as verificações, aprova o CNPJ
        $cnpj->status = 'aprovado';
        $cnpj->save();
    }
}
