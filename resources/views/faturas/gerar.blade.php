<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerar Fatura de Internet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="#">
                    @csrf

                    <div class="mb-4">
                        <label for="provider" class="block text-sm font-medium text-gray-400">Provedor</label>
                        <select name="provider" id="provider" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="NET">NET</option>
                            <option value="TIM">TIM</option>
                            <option value="VIVO">VIVO</option>
                            <option value="OI">OI</option>
                            <option value="Claro">Claro</option>
                        </select>
                    </div>


                    <div class="mb-4">
                        <label for="razao_social" class="block text-sm font-medium text-gray-400">Razão Social</label>
                        <input type="text" name="razao_social" id="razao_social" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="cnpj" class="block text-sm font-medium text-gray-400">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="rua" class="block text-sm font-medium text-gray-400">Rua</label>
                        <input type="text" name="rua" id="rua" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="numero" class="block text-sm font-medium text-gray-400">Número</label>
                        <input type="text" name="numero" id="numero" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="bairro" class="block text-sm font-medium text-gray-400">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="cidade" class="block text-sm font-medium text-gray-400">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="block text-sm font-medium text-gray-400">Estado (ABREVIADO COM DUAS LETRAS)</label>
                        <input type="text" name="estado" id="estado" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Gerar Fatura</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
