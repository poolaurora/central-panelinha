<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Cnpj;



class InvoiceController extends Controller
{
    public function index(){

        return view('faturas.index');
    }

    public function indexExtrato(){

        return view('faturas.extrato');
    }

    public function generate(Request $request)
{
    set_time_limit(0);
    ini_set('memory_limit', '-1');

    $request->validate([
        'banco' => 'required',
        'razao_social' => 'required|string',
        'agencia' => 'required',
        'periodo' => 'required|integer',
        'faturamento' => 'required',
        'transacoes' => 'required|integer|min:1',
        'saldo' => 'required',
        'investimento' => 'required',  // Adiciona a validação para o saldo de investimento
    ]);

    $periodo = $request->input('periodo');
    $min_transacoes = $request->input('transacoes');
    $saldo_inicial = $this->convertToNumber($request->input('saldo'));
    $faturamento = $this->convertToNumber($request->input('faturamento'));
    $saldo_investimento = $this->convertToNumber($request->input('investimento')); // Converte o saldo de investimento
    $agencia = $request->input('agencia');
    $razao = $request->input('razao_social');

    // Geração do período no formato "dd/mm/yyyy a dd/mm/yyyy"
    $start_date = Carbon::now()->subMonths($periodo)->format('d/m/Y');
    $end_date = Carbon::now()->format('d/m/Y');

    // Geração da data e hora atual
    $data_hora = Carbon::now()->format('d/m/Y \à\s H:i');

    $random_digit = rand(0, 999999999);

    $file_name = $random_digit.'-EXTRATO-2024.pdf';

    $resultado = $this->gerarTransacoes($periodo, $min_transacoes, $saldo_inicial, $faturamento);

    $transacoes = $resultado['transacoes'];
    $saldo_final = $resultado['saldo_final'];
    $ultima_data = $resultado['ultima_data'];

    $pdf = Pdf::loadView('faturas.extratos.santander', compact('transacoes', 'agencia', 'saldo_inicial', 'saldo_final', 'saldo_investimento', 'razao', 'start_date', 'end_date', 'data_hora', 'ultima_data', 'file_name'));
    
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

    // Calcular a faixa de 20 a 30% do faturamento
    $min_faturamento = $faturamento * 2.8;
    $max_faturamento = $faturamento * 3.0;
    $faturamento_distribuir = rand($min_faturamento, $max_faturamento);

    // Gerar transações e calcular saldo inicial
    for ($i = 0; $i < $min_transacoes; $i++) {
        $data = Carbon::createFromTimestamp(rand($start_date->timestamp, $end_date->timestamp));
        $dataFormatted = $data->format('d/m/Y');
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

    $ajuste = $faturamento_distribuir / $total_entradas;

    foreach ($transacoes as &$transacao) {
        if ($transacao['tipo'] === 'entrada') {
            $transacao['valor'] *= $ajuste;
        }
    }

    // Ordenar transações por data (mais antigas primeiro)
    usort($transacoes, function ($a, $b) {
        return Carbon::createFromFormat('d/m/Y', $a['data'])->timestamp - Carbon::createFromFormat('d/m/Y', $b['data'])->timestamp;
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


    private function gerarHistorico($dataCard, $cnpj)
    {
        $historicos = [
            [
                'tipo' => 'entrada',
                'descricao' => 'DEP DINHEIRO TERMINAL '.rand(0, 99999999999).'',
                'codigo' => rand(0, 999999),
                'probabilidade' => 5,
                'hierarquia' => 1
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'TED MESMA TITULARIDADE CIP TRANSFERENCIA ENTRE CONTA',
                'codigo' => '000000',
                'probabilidade' => 15,
                'hierarquia' => 5
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'PAGAMENTO CARTAO DE DEBITO GETNET-VISA ELECTR',
                'codigo' => rand(0, 999999),
                'probabilidade' => 1,
                'hierarquia' => 8
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'PAGAMENTO CARTAO DE DEBITO GETNET-MAESTRO',
                'codigo' => rand(0, 999999),
                'probabilidade' => 1,
                'hierarquia' => 8
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'PAGAMENTO CARTAO DE DEBITO GETNET-ELO DEBITO',
                'codigo' => rand(0, 999999),
                'probabilidade' => 1,
                'hierarquia' => 8
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'ANTECIPACAO GETNET',
                'codigo' => rand(0, 999999),
                'probabilidade' => 1,
                'hierarquia' => 8
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'PIX RECEBIDO OUTRA INST - DIF TIT '.$cnpj->razao_social.'',
                'codigo' => '000000',
                'probabilidade' => 10,
                'hierarquia' => 6
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'PIX RECEBIDO - DIF TIT '.rand(0, 99999999999).'',
                'codigo' => rand(0, 999999),
                'probabilidade' => 10,
                'hierarquia' => 6
            ],
            [
                'tipo' => 'entrada',
                'descricao' => 'RESGATE AUT CONTAMAX EMPRESARIAL',
                'codigo' => '000000',
                'probabilidade' => 2,
                'hierarquia' => 8
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'PIX ENVIADO OUTRA INST - DIF TIT '.$cnpj->razao_social.'',
                'codigo' => rand(0, 999999),
                'probabilidade' => 8,
                'hierarquia' => 4
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'TED MESMA TITULARIDADE CIP TRANSFERENCIA ENTRE CONTA',
                'codigo' => rand(0, 999999),
                'probabilidade' => 7,
                'hierarquia' => 5
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'TARIFA AVULSA ENVIO PIX',
                'codigo' => '000000',
                'probabilidade' => 1,
                'hierarquia' => 1
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'SAQUE TERMINAL INTER AG',
                'codigo' => rand(0, 999999),
                'probabilidade' => 3,
                'hierarquia' => 1
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'SAQUE BANCO 24HS',
                'codigo' => rand(0, 999999),
                'probabilidade' => 3,
                'hierarquia' => 1
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'COMPRA CARTAO DEB MC '.$dataCard.' '.$cnpj->razao_social.'',
                'codigo' => rand(0, 999999),
                'probabilidade' => 6,
                'hierarquia' => 2
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'PAGAMENTO DE SALÁRIOS',
                'codigo' => rand(0, 999999),
                'probabilidade' => 1,
                'hierarquia' => 6
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'APLICACAO AUT CONTAMAX EMPRESARIAL',
                'codigo' => '000000',
                'probabilidade' => 2,
                'hierarquia' => 6
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'TRANSF VALOR P/ CONTA DIF TITULAR '.rand(0, 99999999999).'',
                'codigo' => '000000',
                'probabilidade' => 4,
                'hierarquia' => 6
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'PIX ENVIADO OUTRA INST - DIF TIT '.$cnpj->razao_social.'',
                'codigo' => '000000',
                'probabilidade' => 4,
                'hierarquia' => 4
            ],
            [
                'tipo' => 'saida',
                'descricao' => 'PGTO TITULO OUTRO BCO - '.$cnpj->razao_social.'',
                'codigo' => '000000',
                'probabilidade' => 2,
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
