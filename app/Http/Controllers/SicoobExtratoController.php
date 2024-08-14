<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Cnpj;

class SicoobExtratoController extends Controller
{
    public function generate(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
    
        $request->validate([
            'banco' => 'required',
            'cooperativa' => 'required',
            'razao_social' => 'required|string',
            'agencia' => 'required',
            'periodo' => 'required|integer',
            'faturamento' => 'required',
            'transacoes' => 'required|integer|min:1',
            'saldo' => 'required',
            'cheque' => 'required', 
        ]);
    
        $periodo = $request->input('periodo');
        $min_transacoes = $request->input('transacoes');
        $saldo_inicial = $this->convertToNumber($request->input('saldo'));
        $faturamento = $this->convertToNumber($request->input('faturamento'));
        $cheque_especial = $this->convertToNumber($request->input('cheque')); // Converte o saldo de investimento
        $agencia = $request->input('agencia');
        $cooperativa = $request->input('cooperativa');
        $razao = $request->input('razao_social');

        // Geração do período no formato "dd/mm/yyyy a dd/mm/yyyy"
        $start_date = Carbon::now()->subMonths($periodo)->format('d/m/Y');
        $end_date = Carbon::now()->format('d/m/Y');
    
        // Geração da data e hora atual
        $data_hora = Carbon::now()->format('d/m/Y \à\s H:i');
    
        $random_digit = rand(0, 999999999);
    
        $file_name = $random_digit.'-sicoob-'.$start_date.'.pdf';
    
        $resultado = $this->gerarTransacoes($periodo, $min_transacoes, $saldo_inicial, $faturamento);
    
        $transacoes = $resultado['transacoes'];
        $saldo_final = $resultado['saldo_final'];
        $ultima_data = $resultado['ultima_data'];
    
        $pdf = Pdf::loadView('faturas.extratos.sicoob', compact('cooperativa','transacoes', 'agencia', 'saldo_inicial', 'saldo_final', 'cheque_especial', 'razao', 'start_date', 'end_date', 'data_hora', 'ultima_data', 'file_name'));
        
        return $pdf->stream($file_name);
    }
        
    
    private function convertToNumber($value)
    {
        // Remove todos os pontos e substitui a vírgula por ponto
        return floatval(str_replace(['.', ','], ['', '.'], $value));
    }
    
    private function gerarTransacoes($periodo, $min_transacoes, $saldo_inicial, $faturamento)
    {
        $transacoes = [];
        $start_date = Carbon::now()->subMonths($periodo);
        $end_date = Carbon::now();
    
        // Gerar transações e calcular saldo inicial
        for ($i = 0; $i < $min_transacoes; $i++) {
            $data = Carbon::createFromTimestamp(rand($start_date->timestamp, $end_date->timestamp));
            $dataFormatted = $data->format('d/m');
            $dataCard = $data->format('d/m');
            $cnpj = Cnpj::where('status', 'reprovado')->inRandomOrder()->first();
            $historico = $this->gerarHistorico($dataCard, $cnpj);
            $codigo = $historico['codigo'];
            $descricao = $historico['descricao'];
            $valor = $this->gerarValor($historico['hierarquia'], $faturamento);
            $tipo = $historico['tipo'];
    
            // Definir valor da transação e ajustar saldo
            $valor_transacao = $tipo === 'entrada' ? $valor : -$valor;
            $transacoes[] = [
                'data' => $dataFormatted,
                'historico' => $descricao,
                'codigo' => $codigo,
                'valor' => $valor_transacao,
                'tipo' => $tipo
            ];
        }
    
        // Calcular o total das entradas e ajustar para 20-30% do faturamento
        $total_entradas = array_reduce($transacoes, function ($carry, $transacao) {
            return $carry + ($transacao['tipo'] === 'entrada' ? $transacao['valor'] : 0);
        }, 0);
    
    
        foreach ($transacoes as &$transacao) {
            if ($transacao['tipo'] === 'entrada') {
                $transacao['valor'] *= 0.50;
            }
        }
    
        // Ordenar transações por data (mais antigas primeiro)
        usort($transacoes, function ($a, $b) {
            return Carbon::createFromFormat('d/m', $a['data'])->timestamp - Carbon::createFromFormat('d/m', $b['data'])->timestamp;
        });
    
        // Atualizar saldo para cada transação e capturar o saldo final
        $saldo_atual = $saldo_inicial;
        $previous_date = null;
        foreach ($transacoes as &$transacao) {
            $saldo_atual += $transacao['valor'];
            $transacao['saldo'] = $saldo_atual;
            $previous_date = $transacao['data'];
        }
    
        return ['transacoes' => $transacoes, 'saldo_final' => $saldo_atual, 'ultima_data' => $previous_date];
    }
    
    private function gerarValor($hierarquia, $faturamento)
    {
        // Define the fraction of the turnover for each hierarchy level
        $fractions = [
            1 => 0.001,  // 0.1% of the turnover
            2 => 0.002,  // 0.2% of the turnover
            3 => 0.003,  // 0.3% of the turnover
            4 => 0.005,  // 0.5% of the turnover
            5 => 0.01,   // 1% of the turnover
            6 => 0.02,   // 2% of the turnover
            7 => 0.03,   // 3% of the turnover
            8 => 0.05,   // 5% of the turnover
            9 => 0.1,    // 10% of the turnover
            10 => 0.2    // 20% of the turnover
        ];
    
        // Get the fraction for the given hierarchy
        $fraction = $fractions[$hierarquia] ?? 0.001;
    
        // Calculate the value based on the fraction of the turnover
        $max_value = $faturamento * $fraction;
    
        // Return a random value within the calculated range
        return rand(1, $max_value);
    }
    
    public function formatarCnpj($cnpj)
{
    // Remove caracteres não numéricos
    $cnpj = preg_replace('/\D/', '', $cnpj);

    // Verifica se o CNPJ possui 14 dígitos
    if (strlen($cnpj) === 14) {
        // Formata o CNPJ
        return substr($cnpj, 0, 2) . '.' . 
               substr($cnpj, 2, 3) . '.' . 
               substr($cnpj, 5, 3) . ' ' . 
               substr($cnpj, 8, 4) . '-' . 
               substr($cnpj, 12, 2);
    }

    return $cnpj; // Retorna o CNPJ original se não tiver 14 dígitos
}

    
        private function gerarHistorico($dataCard, $cnpj)
        {
            $historicos = [
                [
                    'tipo' => 'entrada',
                    'descricao' => '<td style="">' .
                            htmlspecialchars('PIX REC.OUTRA IF MT') . '<br>' .
                            htmlspecialchars('Recebimento Pix') . '<br>' .
                            htmlspecialchars($cnpj->razao_social) . '<br>' .
                            htmlspecialchars($this->formatarCnpj($cnpj->cnpj)) .
                            htmlspecialchars('DOC.: Pix') .
                        '</td>',
                    'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 8
                ],
                [
                    'tipo' => 'entrada',
                    'descricao' => '<td style="">' .
                            htmlspecialchars('CRÉD.LIQ.COBRANÇA') . '<br>' .
                            htmlspecialchars('DOC.: ' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT)) . 
                            '</td>',
                    'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 8
                ],
                [
                    'tipo' => 'entrada',
                    'descricao' => '<td style="">' .
                            htmlspecialchars('PIX REC.OUTRA IF MT') . '<br>' .
                            htmlspecialchars('Recebimento Pix') . '<br>' .
                            htmlspecialchars($cnpj->razao_social) . '<br>' .
                            htmlspecialchars($this->formatarCnpj($cnpj->cnpj)) . '<br>' .
                            htmlspecialchars('DOC.: Pix') .
                        '</td>',
                    'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 8
                ],
                [
                    'tipo' => 'entrada',
                    'descricao' => '<td style="">' .
                            htmlspecialchars('CRÉD.LIQ.COBRANÇA') . '<br>' .
                            htmlspecialchars('DOC.: ' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT)) .
                            '</td>',
                    'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 8
                ],
                
                [
                    'tipo' => 'saida',
                    'descricao' => '<td style="">' .
                        htmlspecialchars('COMP MASTER MAESTRO', ENT_QUOTES, 'UTF-8') . '<br>' .
                        htmlspecialchars($cnpj->razao_social) . '<br>' .
                        'DOC.: ' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) .
                        '</td>',
                    'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 4
                ],
                [
                    'tipo' => 'saida',
                    'descricao' => '<td style="">' .
                        htmlspecialchars('DÉB.CONV.DEM.EMPRES', ENT_QUOTES, 'UTF-8') . '<br>' .
                        'DOC.: MASTERCARD' .
                        '</td>',
                    'codigo' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 7
                ],
                [
                    'tipo' => 'saida',
                    'descricao' => '<td style="">' .
                        htmlspecialchars('PIX.EMIT.OUT IF-MSM', ENT_QUOTES, 'UTF-8') . '<br>' .
                        'DOC.: PIX' .
                        '</td>',
                    'codigo' => str_pad(rand(0, 999999), 3, '0', STR_PAD_LEFT),
                    'probabilidade' => 5,
                    'hierarquia' => 6
                ],
                [
                    'tipo' => 'saida',
                    'descricao' => '<td style="">' .
                        htmlspecialchars('DEB.TR.CT.DIF.TIT', ENT_QUOTES, 'UTF-8') . '<br>' .
                        'FAV.: '.$cnpj->razao_social.'<br>'.
                        'DOC.: ' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) .
                        '</td>',
                    'codigo' => str_pad(rand(0, 999999), 3, '0', STR_PAD_LEFT),
                    'probabilidade' => 6,
                    'hierarquia' => 5
                ],
            ];
    
            // Criar uma lista ponderada de históricos baseado na probabilidade
            $historicos_ponderados = [];
            foreach ($historicos as $historico) {
                for ($i = 0; $i < $historico['probabilidade']; $i++) {
                    $historicos_ponderados[] = $historico;
                }
            }
    
            // Selecionar um histórico aleatório da lista ponderada
            $historico_escolhido = $historicos_ponderados[array_rand($historicos_ponderados)];
    
            return $historico_escolhido;
        }




}
