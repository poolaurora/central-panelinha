<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pix;


class PixController extends Controller
{
    public function view(){

        return view('pix');
    }

    public function generate(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'amount' => 'required',
        ]);

        // Obter o valor e converter para centavos
        $amount = str_replace(['.', ','], ['', '.'], $request->input('amount'));
        $amountInCents = intval(floatval($amount) * 100);

        $appId = env('APP_ID_SQALA');
        $appSecret = env('APP_SECRET');
        $base64Credentials = base64_encode("{$appId}:{$appSecret}");
        
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $base64Credentials,
            'Content-Type' => 'application/json'
        ])->post('https://api.sqala.tech/core/v1/access-tokens', [
            'refreshToken' => env('REFRESH_TOKEN')
        ]);
        
        $data = $response->json();
    
        $order_id = uniqid();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $data['token'],
            'Content-Type' => 'application/json'
        ])->post('https://api.sqala.tech/core/v1/pix-qrcode-payments', [
            'amount' => $amountInCents,
            'code' => $order_id
        ]);
    
        if ($response->successful()) {

            $data = $response->json();

           $pix = Pix::create([
                'amount' => $amount,
                'pix_url' => $data['payload'],
            ]);

            return redirect()->route('pix.qrcode', ['id' => $pix->id]);
            $data = $response->json();
        } else {
            return response()->json(['error' => 'Falha na criação do QR Code', $response->json()], 500);
        }
    }

    public function qrcode($id){

        $pix = Pix::find($id);

        return view('qrcode', compact('pix'));
    }

}
