<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ferramentas CNPJ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('cnpj.consulta.cnpj') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-building text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Consulta de empresas</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
