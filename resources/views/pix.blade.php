<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerar Pix') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-gray-800 text-white overflow-hidden shadow-xl w-4/12 sm:rounded-lg p-4 flex flex-col items-center">
                <form method="POST" action="{{ route('generate-pix') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-white">Valor</label>
                        <input type="text" name="amount" id="amount" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required oninput="formatCurrency(this)">
                    </div>

                    <div class="mb-4">
                        <label for="gateway" class="block text-sm font-medium text-white">Gateway</label>
                        <select name="gateway" id="gateway" class="mt-1 block w-full bg-gray-900 rounded-md border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="" disabled selected>Selecione o gateway</option>
                            <option value="gateway1">SQALA-VIVERE</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Gerar Pix</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, '');
            value = (value / 100).toFixed(2) + '';
            value = value.replace(".", ",");
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            input.value = value;
        }
    </script>
</x-app-layout>
