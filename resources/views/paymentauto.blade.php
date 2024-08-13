<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Gerar Pagamento e Cadastrar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex justify-center space-x-6">
            <!-- Formulário para Gerar Link de Pagamento -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('payments.store') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-regular fa-credit-card text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Cadastrar Cartões</span>
                </a>
                <a href="{{ route('payments.index') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-list text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Ver Cartões Cadastrados</span>
                </a>
                <a href="{{ route('payments.index.subconta') }}" class="p-4 m-2 bg-gray-800 flex w-full flex-col text-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-layer-group text-gray-300 text-8xl p-4"></i>
                    <span class="text-gray-300 font-bold text-2xl">Cadastrar SubConta</span>
                </a>
               
            </div>
        </div>
    </div>

</x-app-layout>
