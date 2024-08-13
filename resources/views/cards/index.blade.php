<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Cartões e suas empresas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Empresa</th>
                            <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">CNPJ</th>
                            <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cartões Ativos</th>
                            <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cartões Inativos</th>
                            <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cartões Secados</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-600">
                        @foreach ($empresas as $empresa)
                            <tr class="hover:bg-gray-700 cursor-pointer" onclick="window.location='{{ route('payments.show', $empresa->id) }}'">
                                <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $empresa->empresa_razao }}</td>
                                <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $empresa->empresa_cnpj }}</td>
                                <td class="px-6 py-4 text-gray-400 whitespace-nowrap">
                                    @if($empresa->empresa_status === 'active')
                                        <span class="text-green-400 font-bold">ATIVA</span>
                                    @elseif($empresa->empresa_status === 'inactive')
                                        <span class="text-red-400 font-bold">INATIVA</span>
                                    @elseif($empresa->empresa_status === 'secada')
                                        <span class="text-orange-400 font-bold">SECA</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-green-400 whitespace-nowrap">{{ $empresa->active_cards_count }}</td>
                                <td class="px-6 py-4 text-red-400 whitespace-nowrap">{{ $empresa->inactive_cards_count }}</td>
                                <td class="px-6 py-4 text-orange-400 whitespace-nowrap">{{ $empresa->secado_cards_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
