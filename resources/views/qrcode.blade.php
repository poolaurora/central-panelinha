<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('QRCode Pix') }}
        </h2>
    </x-slot>
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-lg mx-auto bg-gray-800 rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="p-6 w-full">
                    <div class="uppercase tracking-wide text-sm text-indigo-400 font-semibold">Pedido: {{ $pix->id }}</div>
                    <p class="block mt-1 text-lg leading-tight font-medium text-white">Valor: R$ {{ $pix->amount }}</p>
                    <p class="mt-2 text-gray-300">Copie o código abaixo e cole no seu banco na função PIX Copia e Cola.</p>
                    <div class="mt-4 bg-gray-700 p-4 rounded-lg font-mono text-sm break-words text-white">
                    <span id="pixCode">{{ $pix->pix_url }}</span>
                </div>
                <button id="copyButton" class="mt-4 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M13.6,7.5h2l-4-4l-4,4h2v6h-2l4,4l4-4h-2V7.5z"/>
                    </svg>
                    <span>Copiar código (PIX Copia e Cola)</span>
                </button>
                    <p class="mt-6 text-gray-300">Você também pode tentar lendo o nosso QRCode:</p>
                    <div class="mt-2 flex justify-center">
                        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                            <div id="qrcode"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <script>
    var QR_CODE = new QRCode("qrcode", {
        width: 220,
        height: 220,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.L, // Use um nível de correção de erros menor
    });

    QR_CODE.makeCode("{{ $pix->pix_url }}")
    </script>

        <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            const pixCode = document.getElementById('pixCode').innerText;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(pixCode).then(() => {
                    alert('Código PIX copiado!');
                }).catch(err => {
                    console.error('Erro ao copiar o texto: ', err);
                    alert('Erro ao copiar o código PIX.');
                });
            } else {
                // Fallback para browsers que não suportam clipboard.writeText
                // Utilizando execCommand para copiar conteúdo para o clipboard
                const textarea = document.createElement('textarea');
                textarea.value = pixCode;
                document.body.appendChild(textarea);
                textarea.select();

                try {
                    const successful = document.execCommand('copy');
                    const msg = successful ? 'Código PIX copiado!' : 'Erro ao copiar o código PIX.';
                    alert(msg);
                } catch (err) {
                    console.error('Erro ao copiar o texto com execCommand: ', err);
                    alert('Erro ao copiar o código PIX.');
                }

                document.body.removeChild(textarea);
            }
        });
    </script>
</x-app-layout>
