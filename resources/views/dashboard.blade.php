<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('pix.view') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-brands fa-pix text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Gerar Pix</span>
                </a>
                <a href="{{ route('contabilidade.view') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-wallet text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Contabilidade</span>
                </a>
                <a href="{{ route('contabilidade.ads.view') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-brands fa-facebook text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Contabilidade Ads</span>
                </a>
                <a href="{{ route('email.view') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-envelope text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Email Corporativo</span>
                </a>
                <a href="{{ route('payments.view') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-credit-card text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Fazer pagamento</span>
                </a>

                <a href="{{ route('cnpj.index') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-building text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Consultar CNPJ</span>
                </a>

                <a href="{{ route('pdf.index') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-file text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">PDF`S</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
