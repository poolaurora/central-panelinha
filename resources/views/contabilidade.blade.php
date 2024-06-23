<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contabilidade') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center">
            <!-- Saldo Atual -->
            <div class="bg-gray-800 text-white overflow-hidden shadow-xl w-full sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-semibold mb-4">Saldo Atual</h3>
                <p class="text-xl">{{ $saldoAtual }} BRL</p>
            </div>

            <!-- Adicionar Entrada/Saída -->
            <div class="bg-gray-800 text-white overflow-hidden shadow-xl w-full sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-semibold mb-4">Adicionar Entrada/Saída</h3>
                <form method="POST" action="{{ route('contabilidade.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-white">Tipo</label>
                        <select name="tipo" id="tipo" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>Selecione o tipo</option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="valor" class="block text-sm font-medium text-white">Valor</label>
                        <input type="number" step="0.01" name="valor" id="valor" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="descricao" class="block text-sm font-medium text-white">Descrição</label>
                        <input type="text" name="descricao" id="descricao" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Adicionar</button>
                    </div>
                </form>
            </div>

            <!-- Histórico -->
            <div class="bg-gray-800 text-white overflow-hidden shadow-xl w-full sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4">Histórico</h3>
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        @foreach ($historico as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ ucfirst($item->tipo) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $item->valor }} BRL</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $item->descricao }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
