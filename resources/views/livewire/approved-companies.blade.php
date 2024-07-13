<div wire:poll.2000ms="approvedCompanies">
    
<div id="aprovadas" class="p-4 bg-gray-900 shadow-inner h-64 overflow-auto">
    <!-- Resultados aprovadas serão exibidos aqui -->
    @foreach($approvedCompanies as $company)
        <div class="bg-gray-800 p-2 rounded-lg mb-2">
            <p class="text-gray-300"><strong>CNPJ:</strong> {{ $company->cnpj }}</p>
            <p class="text-gray-300"><strong>Nome da Empresa:</strong> {{ $company->razao_social }}</p>
            <p class="text-green-500"><strong>Status:</strong> Aprovada</p>
        </div>
    @endforeach
</div>

</div>
