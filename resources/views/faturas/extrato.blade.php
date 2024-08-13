<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerar Extrato Bancário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-gray-800 text-white overflow-hidden shadow-xl w-full sm:w-8/12 md:w-6/12 lg:w-4/12 rounded-lg p-6 flex flex-col items-center">
            <form method="POST" x-data="{ banco: '', faturamento: '', saldo: '', investimento: '' }" @submit.prevent="setAction($event)" class="w-full">
                @csrf
                    <div class="mb-6">
                        <label for="banco" class="block text-sm font-medium text-gray-300">Banco</label>
                        <select name="banco" id="banco" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="banco" required>
                            <option value="" disabled selected>Selecione o banco</option>
                            <option value="santander">Santander</option>
                            <option value="sicoob">Sicoob</option>
                        </select>
                    </div>

                    <div x-show="banco === 'santander'" class="w-full" x-bind:disabled="banco !== 'santander'">
                        <div class="mb-6">
                            <label for="agencia" class="block text-sm font-medium text-gray-300">Agencia</label>
                            <input type="text" name="agencia" id="agencia" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'santander'">
                        </div>
                        <div class="mb-6">
                            <label for="razao_social" class="block text-sm font-medium text-gray-300">Razão Social</label>
                            <input type="text" name="razao_social" id="razao_social" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'santander'">
                        </div>
                        <div class="mb-6">
                            <label for="periodo" class="block text-sm font-medium text-gray-300">Período do Extrato</label>
                            <select name="periodo" id="periodo" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'santander'">
                                <option value="" disabled selected>Selecione o período</option>
                                <option value="1">1 mês</option>
                                <option value="3">3 meses</option>
                                <option value="6">6 meses</option>
                                <option value="12">1 ano</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="faturamento" class="block text-sm font-medium text-gray-300">Faturamento nesse Período</label>
                            <input type="text" name="faturamento" id="faturamento" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="faturamento" x-on:input="faturamento = formatCurrency($event.target.value)" x-bind:required="banco === 'santander'">
                        </div>
                        <div class="mb-6">
                            <label for="transacoes" class="block text-sm font-medium text-gray-300">Minimo de transações</label>
                            <input type="number" name="transacoes" id="transacoes" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'santander'">
                        </div>
                        <div class="mb-6">
                            <label for="investimento" class="block text-sm font-medium text-gray-300">Saldo Em Investimento</label>
                            <input type="text" name="investimento" id="investimento" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="investimento" x-on:input="investimento = formatCurrency($event.target.value)" x-bind:required="banco === 'santander'">
                        </div>
                        <div class="mb-6">
                            <label for="saldo" class="block text-sm font-medium text-gray-300">Saldo Inicial em Conta</label>
                            <input type="text" name="saldo" id="saldo" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="saldo" x-on:input="saldo = formatCurrency($event.target.value)" x-bind:required="banco === 'santander'">
                        </div>
                    </div>

                    <div x-show="banco === 'sicoob'" class="w-full" x-bind:disabled="banco !== 'sicoob'">
                        <div class="mb-6">
                            <label for="agencia" class="block text-sm font-medium text-gray-300">Agencia</label>
                            <input type="text" name="agencia" id="agencia" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'sicoob'">
                        </div>
                        <div class="mb-6">
                            <label for="razao_social" class="block text-sm font-medium text-gray-300">Razão Social</label>
                            <input type="text" name="razao_social" id="razao_social" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'sicoob'">
                        </div>
                        <div class="mb-6">
                            <label for="cooperativa" class="block text-sm font-medium text-gray-300">Cooperativa</label>
                            <input type="text" name="cooperativa" id="cooperativa" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'sicoob'">
                        </div>
                        <div class="mb-6">
                            <label for="periodo" class="block text-sm font-medium text-gray-300">Período do Extrato</label>
                            <select name="periodo" id="periodo" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'sicoob'">
                                <option value="" disabled selected>Selecione o período</option>
                                <option value="1">1 mês</option>
                                <option value="3">3 meses</option>
                                <option value="6">6 meses</option>
                                <option value="12">1 ano</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="faturamento" class="block text-sm font-medium text-gray-300">Faturamento nesse Período</label>
                            <input type="text" name="faturamento" id="faturamento" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="faturamento" x-on:input="faturamento = formatCurrency($event.target.value)" x-bind:required="banco === 'sicoob'">
                        </div>
                        <div class="mb-6">
                            <label for="transacoes" class="block text-sm font-medium text-gray-300">Minimo de transações</label>
                            <input type="number" name="transacoes" id="transacoes" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-bind:required="banco === 'sicoob'">
                        </div>
                        <div class="mb-6">
                            <label for="investimento" class="block text-sm font-medium text-gray-300">Saldo Em Investimento</label>
                            <input type="text" name="investimento" id="investimento" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="investimento" x-on:input="investimento = formatCurrency($event.target.value)" x-bind:required="banco === 'sicoob'">
                        </div>
                        <div class="mb-6">
                            <label for="saldo" class="block text-sm font-medium text-gray-300">Saldo Inicial em Conta</label>
                            <input type="text" name="saldo" id="saldo" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" x-model="saldo" x-on:input="saldo = formatCurrency($event.target.value)" x-bind:required="banco === 'sicoob'">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Gerar Extrato</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function setAction(event) {
        const form = event.target;
        const banco = form.querySelector('select[name="banco"]').value;

        if (banco === 'santander') {
            form.action = '{{ route("pdf.santander.gerar") }}';
        } else if (banco === 'sicoob') {
            form.action = '{{ route("pdf.sicoob.gerar") }}';
        }

        form.submit();
    }
</script>


<script>
    function formatCurrency(value) {
        value = value.replace(/\D/g, '');
        value = (value / 100).toFixed(2) + '';
        value = value.replace(".", ",");
        value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        return value;
    }
</script>
