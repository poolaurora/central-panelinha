<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cnpj;

class CnpjStatus extends Component
{
    public $pendentes;
    public $reprovados;
    public $aprovados;

    public function mount()
    {
        $this->updateCounts();
    }

    public function updateCounts()
    {
        $this->pendentes = Cnpj::where('status', 'pendente')->count();
        $this->reprovados = Cnpj::where('status', 'reprovado')->count();
        $this->aprovados = Cnpj::where('status', 'aprovado')->count();
    }

    public function render()
    {
        return view('livewire.cnpj-status');
    }
}
