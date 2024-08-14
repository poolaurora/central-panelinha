@php
    function generateRandomNumber() {
        $decimalPart = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $hyphenPart = rand(0, 9);
        return "7.$decimalPart-$hyphenPart";
    }

    $randomNumber = generateRandomNumber();
@endphp
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $file_name }}</title>
    <style>

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/Helvetica.woff") }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/Helvetica-Bold.woff") }}') format('woff');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/helvetica-light.woff") }}') format('woff');
            font-weight: 300;
            font-style: normal;
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/helvetica-rounded-bold.woff") }}') format('woff');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/Helvetica-Oblique.woff") }}') format('woff');
            font-weight: normal;
            font-style: oblique;
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/helvetica-compressed.woff") }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('{{ public_path("fonts/sicoob/Helvetica-BoldOblique.woff") }}') format('woff');
            font-weight: bold;
            font-style: oblique;
        }

        body {
            padding: 0;
            margin: 0;
            font-family: 'Helvetica', sans-serif;
        }
        /* Inclua o CSS compilado do Tailwind */
        {!! file_get_contents(public_path('css/tailwind.css')) !!}
        
        /* Estilos adicionais */
        .table td {
            vertical-align: middle;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .left-align {
            text-align: left;
            vertical-align: middle;
        }
        .right-align {
            text-align: right;
            vertical-align: middle;
        }
        /* Garantir que o tamanho da imagem seja respeitado */
        .image-size {
            width: 50px !important;
            height: auto !important;
        }

        .text-gray-200 {
            color: rgb(229 231 235);
        }

        .text-gray-300 {
            color: rgb(209 213 219);
        }

        .text-gray-400 {
            color: rgb(107 114 128);
        }


        .text-2xl {
            font-size: 1.5rem; /* 24px */
            line-height: 2rem; /* 32px */
        }

        /* Tailwind Text Sizes */
        .text-xs {
            font-size: 0.75rem; /* 12px */
            line-height: 1rem; /* 16px */
        }

        .text-sm {
            font-size: 0.875rem; /* 14px */
            line-height: 1.25rem; /* 20px */
        }

        .text-base {
            font-size: 1rem; /* 16px */
            line-height: 1.5rem; /* 24px */
        }

        .text-lg {
            font-size: 1.125rem; /* 18px */
            line-height: 1.75rem; /* 28px */
        }

        .text-xl {
            font-size: 1.25rem; /* 20px */
            line-height: 1.75rem; /* 28px */
        }

        .text-3xl {
            font-size: 1.875rem; /* 30px */
            line-height: 2.25rem; /* 36px */
        }

        .text-4xl {
            font-size: 2.25rem; /* 36px */
            line-height: 2.5rem; /* 40px */
        }

        .text-5xl {
            font-size: 3rem; /* 48px */
            line-height: 1;
        }

        .text-6xl {
            font-size: 3.75rem; /* 60px */
            line-height: 1;
        }

        .text-7xl {
            font-size: 4.5rem; /* 72px */
            line-height: 1;
        }

        .text-8xl {
            font-size: 6rem; /* 96px */
            line-height: 1;
        }

        .text-9xl {
            font-size: 8rem; /* 128px */
            line-height: 1;
        }

        .w-24 {
            width: 20% !important;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-normal {
            font-weight: 400;
        }

        .font-light	{
            font-weight: 300;
        }

        .limited-width {
            width: 150px; /* Ajuste a largura conforme necessário */
            word-wrap: break-word;
        }

        .text-xs2 {
            font-size: 0.65rem; /* 12px */
            line-height: 0.5rem; /* 16px */
        }

        .margin-container {
            margin-top: 40px;
            margin-left: 20px;
        }

        .text-neutral-500 {
            color: rgb(115 115 115);
        }

        .tight-spacing {
            line-height: 0.5;
            margin-bottom: -10px; /* Ajuste conforme necessário */
        }

        table tr:nth-child(odd) {
            background-color: #f4f4f4;
        }

        table th.no-repeat-header {
            display: table-header-group;
        }

    </style>
</head>
<body>

        <div class="text-xs" style="display: block; padding: 20px 40px 30px 40px; text-align: center; margin: 0 auto;">
            <span style="font-weight: bold;">SICOOB</span>
            <br>
            <span style="font-weight: bold;">SISTEMA DE COOPERATIVAS DE CRÉDITO DO BRASIL</span>
            <br>
            <span style="font-weight: bold;">PLATAFORMA DE SERVIÇOS FINANCEIROS DO SICOOB - SISBR</span>
        </div>
   <div style="width: 550px; margin: 0 auto;">    
    <div style="border-bottom: 3px solid black; border-top: 3px solid black; width: 100%;">
        <div class="text-xs" style="display: block; text-align: center;">
            <span style="float: left; font-weight: normal;">{{ now()->format('d/m/Y') }}</span>
            <span style="font-weight: bold;">EXTRATO CONTA CORRENTE</span>
            <span style="float: right; font-weight: normal;">{{ now()->format('H:i:s') }}</span>
            <div style="clear: both;"></div>
        </div>

        <div class="text-xs" style="display: block; text-align: left; margin: 0 auto;">
                <span style="font-weight: bold;">COOP.: <span style="font-weight: normal; text-transform: uppercase;">{{ $agencia }} / {{ $cooperativa }}</span></span>
                <br>
                <span style="font-weight: bold;">CONTA: <span style="font-weight: normal; text-transform: uppercase;">{{ $randomNumber }} / {{ $razao }}</span></span>
                <br>
                <span style="font-weight: bold;">PERÍODO: <span style="font-weight: normal;">{{ $start_date }} - {{ $end_date }}</span></span>
        </div>
    </div>   
    </div>
        <div style="display: block; max-width: 550px; width: 100%; text-align: center; margin: 0 auto; margin-top: 15px;" class="text-xs">
        <span style="font-weight: bold;">HISTÓRICO DE MOVIMENTAÇÃO</span>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px;">
                <tr>
                    <th style="font-weight: bold; text-align: left;">DATA</th>
                    <th style="font-weight: bold; text-align: left;">HISTÓRICO</th>
                    <th style="font-weight: bold; text-align: right;">VALOR</th>
                </tr>
             <tr>
            <td style="">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $start_date)->format('d/m') }}</td>
             <td style="">SALDO ANTERIOR</td>
                    <td style=" text-align: right; color: blue;">{{ number_format($saldo_inicial, 2, ',', '.') }}C</span></td>
                </tr>
                <tr>
                <td style="">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $start_date)->format('d/m') }}</td>
                <td style="">SALDO BLOQ.ANTERIOR</td>
                    <td style="text-align: right; color: blue;">0,00*</span></td>
                </tr>   
            @php $previous_date = null; @endphp
            @foreach($transacoes as $transacao)
                @if($transacao['tipo'] === 'saida')
                    <tr>
                        <td style="vertical-align: top;">{{ $transacao['data'] }}</td>
                        {!! $transacao['historico'] !!}
                        <td style="text-align: right; color: red;">{{ number_format(abs($transacao['valor']), 2, ',', '.') }}D</td>
                        </tr>
                    @if($previous_date !== $transacao['data'])
                        @php $previous_date = $transacao['data']; @endphp
                        <tr>
                            <td></td>
                                <td style="font-style: oblique; vertical-align: top;">SALDO DO DIA</td>
                                <td style="text-align: right; color: blue;">{{ number_format($transacao['saldo'], 2, ',', '.') }}C</span></td>
                            </tr>
                        
                        @endif
                
                @else
                    <tr>
                        <td style="vertical-align: top;">{{ $transacao['data'] }}</td>
                        {!! $transacao['historico'] !!}
                        <td style="color: blue; text-align: right;">{{ number_format($transacao['valor'], 2, ',', '.') }}C</span></td>
                    </tr>

                    @if($previous_date !== $transacao['data'])
                        @php $previous_date = $transacao['data']; @endphp
                        <tr>
                            <td></td>
                                <td style="font-style: italic; vertical-align: top;">SALDO DO DIA</td>
                                <td style="text-align: right; color: blue;">{{ number_format($transacao['saldo'], 2, ',', '.') }}C</span></td>
                            </tr>
                        
                        @endif
                @endif
            @endforeach
        </table>
    </div>
   
<div style="width: 550px; margin: 0 auto;">    
<div style="border-bottom: 3px solid black; border-top: 3px solid black; width: 100%;">
    <div style="display: block; max-width: 550px; width: 100%; text-align: center; margin: 0 auto;" class="text-xs">
        <span style="font-weight: bold;">RESUMO</span>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px;">
            <tbody>
                <tr>
                    <td style="text-align: left;">SALDO EM C.CORRENTE(+):</td>
                    <td style="color: blue; text-align: right;">{{ number_format($saldo_final, 2, ',', '.') }}C</td>
                </tr>
                <tr>
                    <td style="text-align: left;">LIMITE CHEQUE ESP. EMPRESARIAL PLUS (+):</td>
                    <td style="color: blue; text-align: right;">{{ number_format($cheque_especial, 2, ',', '.') }}C</td>
                </tr>
                <tr>
                    <td style="text-align: left;">SALDO DISPONÍVEL(=):</td>
                    <td style="color: blue; text-align: right;">{{ number_format($saldo_final + $cheque_especial, 2, ',', '.') }}C</td>
                </tr>
                <tr>
                    <td style="text-align: left;">SALDO BLOQ.C.CORRENTE: </td>
                    <td style="color: blue; text-align: right;">0,00*</td>
                </tr>
                <tr>
                    <td style="text-align: left;">VENCIMENTO CHEQUE ESP. EMPRESARIAL PLUS:</td>
                    <td style="text-align: right;">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $start_date)->subMonth()->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;">TAXA CHEQUE ESP. EMPRESARIAL PLUS (a.m.):</td>
                    <td style="text-align: right;">1,99%</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
    <div style="display: block; max-width: 550px; width: 100%; text-align: left; margin: 0 auto; margin-top: 5px;" class="text-xs">
        <div style="text-align: center; width: 100%; background-color: #f4f4f4; font-weight: bold;">
            <span style="display: block; width: 100%;">000 EXTRATOS EMITIDOS ATÉ 27/09/2023</span>
        </div>
        <span class="text-xs" style="display: block; width: 100%;">SAC: <span style="font-style: italic;">0800 724 4420</span></span>
        <span class="text-xs" style="display: block; width: 100%;">OUVIDORIA SICOOB: <span style="font-style: italic;">0800 725 0996</span></span>
    </div>
</body>
</html>
