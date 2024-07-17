<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consulta CNPJ') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-md sm:rounded-lg p-6">
            <form action="{{ route('cnpj.import.excel') }}" method="POST" class="mb-6 flex flex-col items-center bg-gray-800 p-6 rounded-lg shadow-lg">
                @csrf
                <label for="textarea_input" class="block text-sm font-medium text-gray-300 mb-4">
                    Insira a lista de CNPJ
                </label>
                <div class="relative w-full mb-4 flex justify-center">
                    <textarea id="textarea_input" name="cnpj_list" rows="10" class="w-full bg-gray-700 border border-gray-600 text-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" placeholder="Cole a lista de CNPJ aqui..."></textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    Carregar
                </button>
                
                @livewire('cnpj-status')
            </form>

  
<div x-data="{ open: false }">
    <!-- Botão para abrir o modal -->
    <button @click="open = true" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
        Limpar CNPJ
    </button>

    <!-- Modal de confirmação -->
    <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                            Limpar CNPJ
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                Tem certeza que deseja limpar todos os registros de CNPJ? Esta ação não pode ser desfeita.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <form action="{{ route('cnpj.clear') }}" method="post" class="inline">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Limpar
                        </button>
                    </form>
                    <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


            <div class="flex flex-col items-center mt-6 space-y-8">
                <div class="w-full max-w-3xl">
                    <div class="bg-gray-700 rounded-t-lg p-4 cursor-pointer flex justify-between items-center" onclick="toggleSection('aprovadas')">
                        <h3 class="text-lg font-semibold text-gray-300">
                            Aprovadas
                        </h3>
                        <i id="aprovadas-icon" class="fas fa-chevron-up text-gray-300"></i>
                    </div>
                    @livewire('approved-companies')
                </div>
                <div class="w-full max-w-3xl">
                    <div class="bg-gray-700 rounded-t-lg p-4 cursor-pointer flex justify-between items-center" onclick="toggleSection('reprovadas')">
                        <h3 class="text-lg font-semibold text-gray-300">
                            Reprovadas
                        </h3>
                        <i id="reprovadas-icon" class="fas fa-chevron-down text-gray-300"></i>
                    </div>
                    @livewire('refused-companies')
                </div>
            </div>



          </div>
</div>
</div>

<script>
    function toggleSection(sectionId) {
        var section = document.getElementById(sectionId);
        var icon = document.getElementById(sectionId + '-icon');
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            section.classList.add('block');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            section.classList.remove('block');
            section.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>
</x-app-layout>
