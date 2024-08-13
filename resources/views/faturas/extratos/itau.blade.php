<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itau Extrato</title>
    <style>

        body {
            padding: 0;
            margin: 0;
        }

        @font-face {
            font-family: 'ItauTextApp';
            src: url('{{ public_path("fonts/itau/ItauTextApp.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'ItauTextApp';
            src: url('{{ public_path("fonts/itau/ItauTextAppBold.ttf") }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        @font-face {
            font-family: 'ItauTextApp';
            src: url('{{ public_path("fonts/itau/ItauTextAppLight.ttf") }}') format('truetype');
            font-weight: 100;
            font-style: thin;
        }
        @font-face {
            font-family: 'ItauTextApp';
            src: url('{{ public_path("fonts/itau/ItauTextAppXBold.ttf") }}') format('truetype');
            font-weight: 800;
            font-style: normal;
        }
        body {
            font-family: 'ItauTextApp', sans-serif;
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

        .table th.no-repeat-header {
            display: table-header-group;
        }

        .tight-spacing {
            line-height: 0.5;
            margin-bottom: -10px; /* Ajuste conforme necessário */
        }

    </style>
</head>
<body>
    <div style="padding: 20px 90px 20px 90px">
        <table class="table">
                <tr>
                    <td class="left-align">
                        <h1 class="text-gray-400 text-2xl" style="font-weight: 800; margin-bottom: -70px">Itaú<span style="font-weight: 100;">Empresas</span></h1>
                    </td>
                </tr>
                <tr>
                    <td class="right-align">
                        <img src="{{ asset('/images/faturas/itau.png') }}" alt="itau" class="image-size">
                    </td>
                </tr>
                <br>
                <h1 style="margin-left: 4px; margin-top: -40px;">dados gerais</span> 
        </table>

        <div style="padding: 10px 140px 20px 0px">
        <table class="table">
    <tr>
        <td class="left-align">
            <span class="text-xs" style="display: block; margin-bottom: -9px;">nome</span>
            <span class="text-sm" style="display: block;">VIVERE MOVEIS LTDA</span>
        </td>
        <td class="right-align">
            <span class="text-xs" style="display: block; margin-bottom: -9px;">agência/conta</span>
            <span class="text-sm" style="display: block;">0574 - 99273-0</span>
        </td>
    </tr>
</table>
<table class="table" style="text-align: right; margin-top: 15px;">
    <tr>
        <td class="left-align">
            <span class="text-xs" style="display: block; margin-bottom: -9px;">data</span>
            <span class="text-sm" style="display: block;">27/06/2024</span>
        </td>
        <td class="right-align">
            <span class="text-xs" style="display: block; margin-bottom: -9px;">horário</span>
            <span class="text-sm" style="display: block;">22:11</span>
        </td>
    </tr>
</table>
         <div style="width: 130%; padding: 0.5px; background-color: rgba(229, 231, 235, 1); margin-top: 50px;"></div>
    </div>

    <div style="margin-top: 30px;">

    <span style="padding: 15px;">extrato</span>

    <div style="display: block; text-align: center; margin: 0 auto; margin-top: 20px;">
    <div style="border: 1px solid black; border-radius: 25%; width: 110px; margin: 0 auto; text-align: center; height: 25px; line-height: 20px;">
        <span class="text-sm" style="display: block; vertical-align: middle; line-height: 1.0; padding: 0;">27/06/2024</span>
    </div>
    </div>


    </div>
</body>
</html>
