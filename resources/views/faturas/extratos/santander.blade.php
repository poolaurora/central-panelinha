<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $file_name }}</title>
    <style>
        /* Inclua o CSS compilado do Tailwind */
        {!! file_get_contents(public_path('css/tailwind.css')) !!}
        
        /* Estilos adicionais */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td {
            vertical-align: middle;
        }
        .left-align {
            text-align: left;
            vertical-align: top;
        }
        .right-align {
            text-align: right;
            vertical-align: top;
        }
        /* Garantir que o tamanho da imagem seja respeitado */
        .image-size {
            width: 140px !important;
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

        .table th.no-repeat-header {
            display: table-header-group;
        }

    </style>
</head>
<body>
    <table class="table">
        <tr>
            <td class="left-align">
                <img src="{{ asset('/images/faturas/santander.png') }}" alt="Santander" class="image-size">
            </td>
            <td class="right-align">
                <h1 class="text-gray-400 text-2xl">Internet Banking Empresarial</h1>
            </td>
        </tr>
    </table>
    <div style="padding: 1px; width: 100%; background-color: rgb(209 213 219); margin-top: 40px;"></div>
    <table class="table">
        <tr>
            <td class="left-align">
            <span class="text-xs limited-width">{{ strtoupper($razao) }}</span>
            </td>
            <td class="right-align">
                <h1 class="text-gray-400 font-bold text-xs">Agência: <span class="font-normal">{{ $agencia }}</span> Conta: <span class="font-normal">{{ str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT) }}</span></h1>
            </td>
        </tr>
    </table>
    <div style="padding: 1px; width: 100%; background-color: rgb(209 213 219); margin-top: 5px;"></div>

    <div style="margin-top: 60px">
        <span class="text-sm text-gray-400">Conta Corrente > Extratos ></span><br>
        <span class="text-base text-gray-500">Consultar</span>
    </div>


<div class="margin-container">
        <table class="table">
            <tr>
                <td class="left-align">
                    <span class="text-xs limited-width font-bold">Opção de Pesquisa: <span class="font-normal">Todos</span></span>
                </td>
            </tr>
        </table>

        <table class="table" style="margin-top: 10px;">
        <tr>
            <td class="left-align">
               <span class="text-xs limited-width font-bold">Períodos: <span class="font-normal">{{ $start_date }} a {{ $end_date }}</span></span>
            </td>
            <td class="right-align">
                <span class="text-xs limited-width font-bold">Data/Hora: <span class="font-normal">{{ $data_hora }}</span></span>
            </td>
        </tr>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-top: 5px;" page-break-inside: auto;>
                <tr>
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Data</th>
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Histórico</th>
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Documento</th>
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Valor (R$)</th>
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Saldo (R$)</th>
                </tr>
            <tbody>
                <tr style="border-bottom: 1px solid rgb(209 213 219); padding: 5px;">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ $start_date }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">SALDO ANTERIOR</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;"></td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;"></td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ number_format($saldo_inicial, 2, ',', '.') }}</td>
                </tr>
                @php $previous_date = null; @endphp

        @foreach($transacoes as $transacao)
            @if($transacao['tipo'] === 'saida')
                <tr style="border-bottom: 1px solid rgb(209 213 219); padding: 5px;">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ $transacao['data'] }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">
                            {{ substr($transacao['historico'], 0, 50) }}
                    </td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ $transacao['codigo'] }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; color: rgb(248, 113, 113);">{{ number_format($transacao['valor'], 2, ',', '.') }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">
                        @if($previous_date !== $transacao['data'])
                            {{ number_format($transacao['saldo'], 2, ',', '.') }}
                            @php $previous_date = $transacao['data']; @endphp
                        @endif
                    </td>
                </tr>
            @else
                <tr style="border-bottom: 1px solid rgb(209 213 219); padding: 5px;">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ $transacao['data'] }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">
                            {{ substr($transacao['historico'], 0, 50) }}
                        </td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ $transacao['codigo'] }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">{{ number_format($transacao['valor'], 2, ',', '.') }}</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem;">
                        @if($previous_date !== $transacao['data'])
                            {{ number_format($transacao['saldo'], 2, ',', '.') }}
                            @php $previous_date = $transacao['data']; @endphp
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach


                
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>

    <table class="table" style="margin-top: 20px;">
        <tr>
            <td class="right-align">
                <span class="text-xs2 limited-width">Saldo em Investimentos com Resgate Automático<span class="font-normal" style="margin-left: 40px;">{{ number_format($saldo_investimento, 2, ',', '.') }}</span></span>
            </td>
        </tr>
    </table>

    <table class="table" style="margin-top: 10px; background-color: rgb(245 245 245); padding: 0px 0px 5px 0px; border-top: 0.5px solid rgb(212 212 212);">
        <tr>
            <td class="right-align">
                <span class="text-xs2 limited-width font-bold text-neutral-500">Saldo Disponível<span class="font-bold" style="margin-left: 20px;">{{ number_format($saldo_final + $saldo_investimento, 2, ',', '.') }}</span></span>
            </td>
        </tr>
    </table>

    <table class="table">
        <tr>
            <td class="left-align">
               <span class="text-xs limited-width">a = Bloqueio Dia / ADM</span>
               <br>
               <span class="text-xs limited-width">b = Bloqueado</span>
               <br>
               <span class="text-xs limited-width">p = Lançamento Provisionado</span>
            </td>
            <td class="right-align">
                <span class="text-xs limited-width">Entenda a composição do seu saldo no quadro abaixo</span>
                <br>
                <span class="text-xs limited-width"></span>
                <br>
                <span class="text-xs limited-width"></span>
            </td>
        </tr>
    </table>

    <table class="table" style="margin-top: 40px;">
        <tr>
            <td class="left-align">
               <span class="text-base limited-width">Saldo</span>
            </td>
    </table>

    <table class="table" style="margin-top: 5px;">
        <tr>
            <td class="left-align">
               <span class="text-xs limited-width font-bold">Posição em: <span class="font-normal">{{ $end_date }}</span> </span>
            </td>
    </table>



    <table style="width: 100%; border-collapse: collapse; margin-top: 10px; page-break-after:auto;">
                <tr class="no-repeat-header">
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Saldo</th>
                    <th style="background-color: rgba(128, 128, 128); color: white; height: 40px; vertical-align: middle; padding: 0 8px; text-align: left; font-size: 0.75rem;">Valor (R$)</th>
                </tr>
            <tbody>
            <tr style="background-color: rgba(128, 128, 128, 0.1);">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">A - Saldo de Conta Corrente</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">{{ number_format($saldo_final, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">B - Saldo Bloqueado</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">0,00</td>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.1);">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219); padding-left: 20px;">Desbloqueio em 1 dia</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">0,00</td>
                </tr>
                <tr>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219); padding-left: 20px;">Desbloqueio em 2 dias</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">0,00</td>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.1);">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219); padding-left: 20px;">Desbloqueio em mais de 2 dias</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">0,00</td>
                </tr>
                <tr>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">C - Saldo Disponível em Conta Corrente (A - B)</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">{{ number_format($saldo_final, 2, ',', '.') }}</td>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.1);">
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">D - Saldo em Investimentos com Resgate Automático</td>
                    <td style="padding: 8px; text-align: left; font-size: 0.65rem; border-bottom: 1px solid rgb(209, 213, 219);">{{ number_format($saldo_investimento, 2, ',', '.') }}</td>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.1);">
                    <td style="padding: 16px 8px 4px 8px; text-align: left; font-size: 0.75rem; border-bottom: 1px solid rgb(209, 213, 219);" class="font-bold text-neutral-500">E - Saldo Disponível (C + D)</td>
                    <td style="padding: 16px 8px 4px 8px;; text-align: left; font-size: 0.75rem; border-bottom: 1px solid rgb(209, 213, 219);" class="font-bold text-neutral-500">{{ number_format($saldo_final + $saldo_investimento, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>




        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="padding: 8px; text-align: left; vertical-align: top; font-size: 0.75rem;">
                    <span style="font-size: 0.55rem; font-weight: bold; display: block;">Central de Atendimento Santander Empresarial</span>
                    <span style="font-size: 0.55rem; display: block;">4004-2125 (Regiões Metropolitanas)</span>
                    <span style="font-size: 0.55rem; display: block;">0800 726 2125 (Demais Localidades)</span>
                    <span style="font-size: 0.55rem; display: block;">0800 723 5007 (Pessoas com deficiência auditiva ou de fala)</span>
                </td>
                <td style="padding: 8px; text-align: left; vertical-align: top; font-size: 0.55rem;">
                    <span style="font-size: 0.55rem; font-weight: bold; display: block;">SAC - <span class="font-normal">Atendimento 24h por dia, todos os dias.</span></span>
                    <span style="font-size: 0.55rem; display: block;"></span>
                    <span style="font-size: 0.55rem; display: block;">0800 762 7777</span>
                    <span style="font-size: 0.55rem; display: block;">0800 771 0401 (Pessoas com deficiência auditiva ou de fala)</span>
                    <span style="font-size: 0.55rem; font-weight: bold; display: block; margin-top: 10px;">Ouvidoria <span style="font-size: 0.55rem;" class="font-normal">- Das 9h às 18h, de segunda a sexta-feira, exceto feriado.</span>
</span>
                    <span style="font-size: 0.55rem; display: block;">0800 726 0322</span>
                    <span style="font-size: 0.55rem; display: block;">0800 771 0301 (Pessoas com deficiência auditiva ou de fala)</span>
                </td>
            </tr>
        </table>

 </div>


</body>
</html>
