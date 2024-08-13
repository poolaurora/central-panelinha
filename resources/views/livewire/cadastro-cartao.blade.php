<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-gray-800 p-6 rounded-lg">
                    @if ($step === 0)
                        <div>
                            <h1 class="text-xl text-gray-200 text-center font-bold">Cartões Cadastrados</h1>
                            <div class="mt-4 items-center flex flex-col">
                                @if(!empty($cards))
                                    <div class="bg-white rounded-lg shadow-md p-4">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Cartões</h2>
                                        <ul class="space-y-4">
                                            @foreach($cards as $card)
                                                <li class="flex flex-col bg-gray-50 rounded-lg p-4 shadow-sm">
                                                    <div class="flex items-center mb-2">
                                                        <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 text-lg font-semibold">
                                                            {{ strtoupper(substr($card['cardholder_name'], 0, 1)) }}
                                                        </div>
                                                        <div class="ml-4">
                                                            <h3 class="text-lg font-medium text-gray-700">{{ $card['cardholder_name'] }}</h3>
                                                            <p class="text-sm text-gray-500">{{ $card['card_number'] }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-wrap gap-4 mb-4">
                                                        <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded-full">{{ $card['expiry_date'] }}</span>
                                                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 rounded-full">{{ $card['cvv'] }}</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-md font-medium text-gray-700 mb-2">Compras</h4>
                                                        <ul class="list-disc list-inside text-gray-600 space-y-1">
                                                            @foreach($card['purchases'] as $purchase)
                                                                <li class="bg-teal-100 text-teal-800 text-sm px-3 py-1 rounded-full">
                                                                    {{ \Carbon\Carbon::parse($purchase['date'])->format('d/m/Y H:i') }} - {{ number_format($purchase['value'], 2, ',', '.') }} - {{ $purchase['name'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                <p class="text-gray-600">Nenhum cartão encontrado.</p>
                                @endif
                                <div class="flex gap-4">
                                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none mt-4 focus:shadow-outline" type="button" wire:click="nextStep">
                                        Criar cartão
                                    </button>
                                    @if(!empty($cards))
                                    <!-- Modal -->
                                    <div x-data="{ showModal: false, cnpj: '' }">
                                        <button 
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none mt-4 focus:shadow-outline"
                                            @click="showModal = true"
                                            type="button"
                                        >
                                            Finalizar Cadastro
                                        </button>

                                        <div
                                            x-show="showModal"
                                            class="fixed z-10 inset-0 overflow-y-auto"
                                            aria-labelledby="modal-title"
                                            role="dialog"
                                            aria-modal="true"
                                        >
                                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div x-show="showModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                                <div
                                                    x-show="showModal"
                                                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                                                >
                                                    <div class="sm:flex sm:items-start">
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                                Confirmar Cadastro
                                                            </h3>
                                                            <div class="mt-2">
                                                                <p class="text-sm text-gray-500">
                                                                    Você tem certeza de que deseja finalizar o cadastro dos cartões?
                                                                </p>
                                                            </div>
                                                            <div class="mt-4">
                                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="cnpj">
                                                                    CNPJ
                                                                </label>
                                                                <input x-model="cnpj" type="text" placeholder="Digite o CNPJ" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                        <button
                                                            type="button"
                                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                                                            @click="showModal = false; $wire.finalizarCadastro(cnpj)"
                                                        >
                                                            Confirmar
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                                            @click="showModal = false"
                                                        >
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif ($step === 1)
                        <div>
                            @csrf
                            <div class="grid grid-cols-1 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="cardholder_name">
                                        Nome do Titular
                                    </label>
                                    <input wire:model="cardholder_name" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="cardholder_name" name="cardholder_name" type="text" placeholder="Nome do Titular" required>
                                    @error('cardholder_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="card_number">
                                        Número do Cartão
                                    </label>
                                    <input wire:model="card_number" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="card_number" name="card_number" type="text" placeholder="Número do Cartão" required pattern="\d{16}" maxlength="16">
                                    @error('card_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="expiry_date">
                                        Data de Validade
                                    </label>
                                    <input wire:model="expiry_date" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="expiry_date" name="expiry_date" type="text" placeholder="MM/AA" required pattern="(0[1-9]|1[0-2])\/\d{2}" maxlength="5">
                                    @error('expiry_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="cvv">
                                        Código de Segurança (CVV)
                                    </label>
                                    <input wire:model="cvv" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="cvv" name="cvv" type="text" placeholder="CVV" required pattern="\d{3}" maxlength="3">
                                    @error('cvv') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" wire:click="nextStep">
                                    Próximo
                                </button>
                            </div>
                        </div>
                    @elseif ($step === 2)
                        <div wire:submit.prevent="addCard">
                            @csrf
                            <div class="grid grid-cols-1 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="new_purchase_date">
                                        Data da Compra
                                    </label>
                                    <input wire:model="new_purchase_date" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="new_purchase_date" name="new_purchase_date" type="datetime-local" required>
                                    @error('new_purchase_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="new_purchase_name">
                                        Nome na Compra
                                    </label>
                                    <div class="flex gap-2">
                                        <input wire:model="new_purchase_name" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="new_purchase_name" name="new_purchase_name" type="text" placeholder="Nome na Compra" required>
                                    </div>
                                    @error('new_purchase_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-500 text-sm font-bold mb-2" for="new_purchase_value">
                                        Valor da Compra
                                    </label>
                                    <div class="flex gap-2">
                                        <input wire:model="new_purchase_value" class="shadow appearance-none bg-gray-700 border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline" id="new_purchase_value" name="new_purchase_value" type="number" step="0.01" placeholder="Valor da Compra" required>
                                        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" wire:click="addPurchase">
                                            Adicionar
                                        </button>
                                    </div>
                                    @error('new_purchase_value') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                @if($purchases)
                                    <div class="mb-4">
                                        <h4 class="text-gray-600 text-sm font-bold mb-2">Compras Adicionadas:</h4>
                                        <ul class="list-disc pl-5">
                                            @foreach($purchases as $purchase)
                                                <li class="text-gray-500 text-sm"> {{ \Carbon\Carbon::parse($purchase['date'])->format('d/m/Y H:i') }} - {{ number_format($purchase['value'], 2, ',', '.') }} - {{ $purchase['name'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" wire:click="previousStep">
                                    Voltar
                                </button>
                                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" wire:click="addCard" type="button">
                                    Criar
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
