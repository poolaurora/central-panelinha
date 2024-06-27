<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Http;


class PaymentsController extends Controller
{
    public function view(){

        $empresas = PaymentSetting::all();

        return view('payment', compact('empresas'));
    }

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
}
