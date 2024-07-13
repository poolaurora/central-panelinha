<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cnpj;

class ApprovedCompanies extends Component
{
    public $approvedCompanies;


    public function mount()
    {
        $this->approvedCompanies();
    }

    public function approvedCompanies()
    {
        $this->approvedCompanies = Cnpj::where('status', 'aprovado')->get();
    }

    public function render()
    {
        return view('livewire.approved-companies');
    }
}
