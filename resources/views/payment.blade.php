<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Gerar Pagamento e Cadastrar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center space-x-6">
            <!-- Formulário para Gerar Link de Pagamento -->
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 w-1/2">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Gerar Pagamento</h3>
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-900 text-red-200 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('payments.create') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-300">Valor</label>
                        <input type="text" name="amount" id="amount" class="mt-1 block text-white w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required oninput="formatCurrency(this)">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-300">Descrição</label>
                        <input type="text" id="description" name="description" required
                            class="mt-1 block w-full rounded-md border-gray-700 shadow-sm bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="gateway" class="block text-sm font-medium text-gray-300">Gateway</label>
                        <select name="gateway" id="gateway" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>Selecione o gateway</option>
                            @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->company_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                            Gerar Link de Pagamento
                        </button>
                    </div>
                </form>
            </div>

            <!-- Formulário para Cadastrar Empresa -->
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 w-1/2">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Cadastrar Empresa</h3>
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-900 text-red-200 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="company_name" class="block text-sm font-medium text-gray-300">Nome da Empresa</label>
                        <input type="text" name="company_name" id="company_name" required
                            class="mt-1 block w-full rounded-md border-gray-700 shadow-sm bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="api_key" class="block text-sm font-medium text-gray-300">API Key</label>
                        <input type="text" name="api_key" id="api_key" required
                            class="mt-1 block w-full rounded-md border-gray-700 shadow-sm bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="api_secret" class="block text-sm font-medium text-gray-300">API Secret</label>
                        <input type="text" name="api_secret" id="api_secret" required
                            class="mt-1 block w-full rounded-md border-gray-700 shadow-sm bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="return_url" class="block text-sm font-medium text-gray-300">URL de Retorno</label>
                        <input type="text" name="return_url" id="return_url" required
                            class="mt-1 block w-full rounded-md border-gray-700 shadow-sm bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="cancel_url" class="block text-sm font-medium text-gray-300">URL de Cancelamento</label>
                        <input type="text" name="cancel_url" id="cancel_url" required
                            class="mt-1 block w-full rounded-md border-gray-700 shadow-sm bg-gray-900 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                            Cadastrar Empresa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function formatCurrency(input) {
        // Remove todos os caracteres que não sejam números
        let value = input.value.replace(/\D/g, '');
        
        // Converte o valor para centavos
        value = (value / 100).toFixed(2) + '';
        
        // Substitui a vírgula decimal por um ponto (se houver)
        value = value.replace(",", ".");
        
        // Atualiza o valor do input
        input.value = value;
    }
</script>

</x-app-layout>
