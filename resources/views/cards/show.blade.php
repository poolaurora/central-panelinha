<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Detalhes da Empresa') }}: {{ $empresa->empresa_razao }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-200">
                        {{ __('Informações da Empresa') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-400">
                        <strong>{{ __('CNPJ:') }}</strong> {{ $empresa->empresa_cnpj }}
                    </p>
                    <p class="mt-1 text-sm text-gray-400">
                        <strong>{{ __('Status:') }}</strong> 
                        @if($empresa->empresa_status === 'active')
                            <span class="text-green-400 font-bold">ATIVA</span>
                        @elseif($empresa->empresa_status === 'inactive')
                            <span class="text-red-400 font-bold">INATIVA</span>
                        @elseif($empresa->empresa_status === 'secada')
                            <span class="text-orange-400 font-bold">SECA</span>
                        @endif
                    </p>
                </div>

                <h3 class="text-lg leading-6 font-medium text-gray-200 mb-4">
                    {{ __('Cartões da Empresa') }}
                </h3>

                @foreach ($empresa->cards as $card)
                    <div class="mb-6 bg-gray-700 p-4 rounded-lg">
                        <h4 class="text-lg leading-6 font-medium text-gray-200">
                            {{ __('Detalhes do Cartão') }}
                        </h4>
                        <p class="mt-1 text-sm text-gray-400">
                            <strong>{{ __('Número do Cartão:') }}</strong> {{ $card->card_number }}
                        </p>
                        <p class="mt-1 text-sm text-gray-400">
                            <strong>{{ __('Nome do Titular:') }}</strong> {{ $card->card_holderName }}
                        </p>
                        <p class="mt-1 text-sm text-gray-400">
                            <strong>{{ __('Data de Expiração:') }}</strong> {{ $card->card_MM }}/{{ $card->card_YY }}
                        </p>
                        <p class="mt-1 text-sm text-gray-400">
                            <strong>{{ __('CVV:') }}</strong> {{ $card->card_cvv }}
                        </p>
                        <p class="mt-1 text-sm text-gray-400">
                            <strong>{{ __('Status:') }}</strong> 
                            @if($card->card_status === 'active')
                                <span class="text-green-400 font-bold">ATIVO</span>
                            @elseif($card->card_status === 'inactive')
                                <span class="text-red-400 font-bold">INATIVO</span>
                            @elseif($card->card_status === 'secado')
                                <span class="text-orange-400 font-bold">SECADO</span>
                            @endif
                        </p>

                        <h5 class="mt-4 text-md leading-6 font-medium text-gray-200">
                            {{ __('Compras do Cartão') }}
                        </h5>

                        <table class="min-w-full divide-y divide-gray-600 mt-2">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-600 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Valor da Compra</th>
                                    <th class="px-6 py-3 bg-gray-600 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Data da Compra</th>
                                    <th class="px-6 py-3 bg-gray-600 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Fatura</th>
                                    <th class="px-6 py-3 bg-gray-600 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-600">
                                @foreach ($card->purchases as $purchase)
                                    <tr>
                                        <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $purchase->compra_value }}</td>
                                        <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $purchase->compra_time }}</td>
                                        <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $purchase->compra_fatura }}</td>
                                        @if($purchase->compra_status === 'pendente')
                                        <td class="px-6 py-4 text-orange-400 font-bold whitespace-nowrap">PENDENTE</td>
                                        @elseif($purchase->compra_status === 'paga')
                                        <td class="px-6 py-4 text-green-400 font-bold whitespace-nowrap">PAGA</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
