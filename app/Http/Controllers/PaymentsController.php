<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Models\Card;
use App\Models\CardCompra;
use App\Models\CardEmpresa;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


class PaymentsController extends Controller
{
    public function view(){

        return view('paymentauto');
    }

    public function index()
    {
        // Busca todas as empresas com a quantidade de cartões cadastrados para cada uma
        $empresas = CardEmpresa::withCount([
            'cards as active_cards_count' => function ($query) {
                $query->where('card_status', 'active');
            },
            'cards as inactive_cards_count' => function ($query) {
                $query->where('card_status', 'inactive');
            },
            'cards as secado_cards_count' => function ($query) {
                $query->where('card_status', 'secado');
            }
        ])->get();

        // Retorna a view com os dados das empresas
        return view('cards.index', compact('empresas'));
    }


    public function show(CardEmpresa $empresa)
{
    $empresa->load(['cards.purchases']); // Carregar os cartões e as compras associadas a cada cartão

    return view('cards.show', compact('empresa'));
}

    public function storeView(){

        return view('cards.store');
    }


    public function storeCardsAndCnpj(array $data)
    {

        $client = new Client();
        
        // Validar o CNPJ
        $cnpj = $data['cnpj'];

        $url = 'https://receitaws.com.br/v1/cnpj/' . $cnpj;

        // Fazer a requisição
        $response = $client->get($url);
        $respondeBody = json_decode($response->getBody(), true);

        // Armazenar a empresa
        $empresa = CardEmpresa::updateOrCreate(
            ['empresa_cnpj' => $cnpj], // Identificador único
            [
                'empresa_razao' =>  $respondeBody['nome'], // Valor para empresa_razao
                'empresa_status' => 'active'         // Valor para empresa_status
            ]
        );

        // Armazenar os cartões e suas compras
        foreach ($data['cards'] as $cardData) {
            $card = Card::updateOrCreate([
                'card_number' => $cardData['card_number'],
                'card_holderName' => $cardData['cardholder_name'],
                'card_YY' => substr($cardData['expiry_date'], -2), // Extraindo o ano
                'card_MM' => substr($cardData['expiry_date'], 0, 2), // Extraindo o mês
                'card_cvv' => $cardData['cvv'],
                'card_empresa_id' => $empresa->id,
                'card_status' => 'active' // Defina o status conforme necessário
            ]);

            foreach ($cardData['purchases'] as $purchase) {
                CardCompra::updateOrCreate([
                    'compra_value' => $purchase['value'],
                    'compra_time' => $purchase['date'],
                    'compra_fatura' => $purchase['name'], // Ajuste conforme necessário
                    'card_id' => $card->id,
                ]);
            }
        }

        return redirect()->route('payments.index');
    }



    public function index_subconta(){

        return view('cards.subconta');
    }


















































































    /*



    public function generatePaymentLink(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'description' => 'required|string|max:255',
            'gateway' => 'required',
        ]);

        
        $gateway = PaymentSetting::find($request->input('gateway'));


        // Substitua pelos seus dados de autenticação e endpoint da DLocal Go API
        $apiKey = $gateway->api_key;
        $apiSecret = $gateway->api_secret;

        $apiUrl = 'https://api.dlocalgo.com/v1/payments';
        // Dados da requisição
        $payload = [
            'amount' => $request->amount,
            'currency' => 'BRL', // Ajuste conforme necessário
            'description' => $request->description,
            'country' => 'BR',
            'redirect_urls' => [
                'return_url' => null,
                'cancel_url' => null,
            ],
        ];

        // Cabeçalhos da requisição
        $headers = [
            'Authorization' => 'Bearer '.$apiKey.':'.$apiSecret,
            'Content-Type' => 'application/json',
        ];

        // Fazer a requisição à DLocal Go API
        $response = Http::withHeaders($headers)->post($apiUrl, $payload);

        if ($response->successful()) {
            $paymentLink = $response->json()['redirect_url'];
            return redirect()->away($paymentLink);
        } else {
            return redirect()->back()->withErrors('Falha ao gerar o link de pagamento.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'api_key' => 'required|string|max:255',
            'api_secret' => 'required|string|max:255',
            'return_url' => 'required|url|max:255',
            'cancel_url' => 'required|url|max:255',
        ]);

        PaymentSetting::create([
            'company_name' => $request->company_name,
            'api_key' => $request->api_key,
            'api_secret' => $request->api_secret,
            'return_url' => $request->return_url,
            'cancel_url' => $request->cancel_url,
        ]);

        return redirect()->back()->with('success', 'Empresa cadastrada com sucesso.');
    }
    
    */
}
