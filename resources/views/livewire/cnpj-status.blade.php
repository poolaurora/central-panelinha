<div wire:poll.4000ms="updateCounts">
    <div class="text-gray-400 mt-4 flex flex-col text-center">
        <span>Pendentes: {{ $pendentes }}</span>
        <span class="text-red-400">Reprovados: {{ $reprovados }}</span>
        <span class="text-green-400">Aprovados: {{ $aprovados }}</span>
    </div>
</div>
