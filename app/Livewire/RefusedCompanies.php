<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cnpj;


class RefusedCompanies extends Component
{

    public $refusedCompanies;

    public function mount()
    {
        $this->refusedCompanies = Cnpj::where('status', 'reprovado')->get();
    }

    public function render()
    {
        return view('livewire.refused-companies');
    }
}
