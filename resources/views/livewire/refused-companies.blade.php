<div>
    <div id="reprovadas" class="p-4 bg-gray-900 shadow-inner h-64 overflow-auto hidden">
    @foreach($refusedCompanies as $company)
         <div class="bg-gray-800 p-2 rounded-lg mb-2">
            <p class="text-gray-300"><strong>CNPJ:</strong> {{ $company->cnpj }}</p>
            <p class="text-gray-300"><strong>Nome da Empresa:</strong> {{ $company->razao_social }}</p>
            <p class="text-red-500"><strong>Status:</strong> Reprovada</p>
            </div>
        @endforeach
    </div>
</div>
