<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Log;

class CadastroCartao extends Component
{
    public $step = 0;
    public $cardholder_name;
    public $card_number;
    public $expiry_date;
    public $cvv;
    public $new_purchase_date;
    public $new_purchase_value;
    public $new_purchase_name;
    public $purchases = [];
    public $cards = [];
    public $cnpj;

    protected function rules()
    {
        switch ($this->step) {
            case 1:
                return [
                    'cardholder_name' => 'required|string|max:255',
                    'card_number' => 'required|digits:16',
                    'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
                    'cvv' => 'required|digits:3',
                ];
            case 2:
                return [
                    'new_purchase_date' => 'required|date_format:"Y-m-d\TH:i"',
                    'new_purchase_value' => 'required|numeric|min:0.01',
                    'new_purchase_name' => 'required|string|max:255',
                ];
            default:
                return [];
        }
    }

    public function nextStep()
    {
        if ($this->step === 1 || $this->step === 2) {
            $this->validate($this->rules());
        }

        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function addPurchase()
    {
        $this->validate([
            'new_purchase_date' => 'required|date_format:"Y-m-d\TH:i"',
            'new_purchase_value' => 'required|numeric|min:0.01',
            'new_purchase_name' => 'required|string|max:255',
        ]);

        $this->purchases[] = [
            'date' => Carbon::createFromFormat('Y-m-d\TH:i', $this->new_purchase_date)->toDateTimeString(),
            'value' => $this->new_purchase_value,
            'name' => $this->new_purchase_name,
        ];

        $this->new_purchase_date = '';
        $this->new_purchase_value = '';
        $this->new_purchase_name = '';
    }

    public function addCard()
    {
        $this->validate([
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => 'required|digits:3',
            'purchases' => 'required|array',
            'purchases.*.date' => 'required|date_format:"Y-m-d H:i:s"',
            'purchases.*.value' => 'required|numeric|min:0.01',
            'purchases.*.name' => 'required|string|max:255',
        ]);

        $this->cards[] = [
            'cardholder_name' => $this->cardholder_name,
            'card_number' => $this->card_number,
            'expiry_date' => $this->expiry_date,
            'cvv' => $this->cvv,
            'purchases' => $this->purchases,
        ];

        $this->resetForm();
        $this->step = 0;
    }

    public function resetForm()
    {
        $this->cardholder_name = '';
        $this->card_number = '';
        $this->expiry_date = '';
        $this->cvv = '';
        $this->purchases = [];
        $this->new_purchase_date = '';
        $this->new_purchase_value = '';
        $this->new_purchase_name = '';
    }

    public function finalizarCadastro($cnpj)
    {

        // Instanciar o Controller
        $cardController = new PaymentsController();
        $cardController->storeCardsAndCnpj([
            'cards' => $this->cards,
            'cnpj' => $cnpj
        ]);

        $this->step = 0;
    }



    public function render()
    {
        return view('livewire.cadastro-cartao');
    }
}
