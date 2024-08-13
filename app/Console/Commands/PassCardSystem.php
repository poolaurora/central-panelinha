<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Card;
use App\Models\CardCompra;
use App\Models\CardEmpresa;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\CardToken;
use Illuminate\Support\Str;


class PassCardSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pass-card-system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
     
        $cartoes = Card::with('purchases')->get();
        $now = Carbon::now();

        foreach ($cartoes as $cartao) {
            foreach ($cartao->purchases as $purchase) {
                $purchaseTime = Carbon::parse($purchase->compra_time);
                $purchase->isDue = $now->isSameDay($purchaseTime) && $now->hour === $purchaseTime->hour;

            if($purchase->isDue && $puchase->compra_status === 'pendente') {
                            $nomeCompleto = $cartao->card_holderName;
                            $nomes = explode(' ', $nomeCompleto);

                            $primeiroNome = $nomes[0];
                            $ultimoNome = end($nomes);
                            // Formata o nome para criar um endereço de email
                            $email_part = strtolower(str_replace(' ', '.', $nomeCompleto));
                            $email = $email_part . '@gmail.com';
                            
                        if(!$cartao->token){
                            $dataToken = [
                                'account_id' => '#',
                                'method' => 'credit_card',
                                'data' => [
                                    'number' => $cartao->card_number,
                                    'verification_value' => $cartao->card_cvv,
                                    'first_name' => $primeiroNome,
                                    'last_name' => $ultimoNome,
                                    'month' => $cartao->card_MM,
                                    'year' => '20'.$cartao->card_YY,
                                ]
                            ];

                            $headers = [
                                'Content-Type' => 'application/json',
                                'Origin' => 'https://api.gl-pagamentos.com.br/',
                            ];
                        
                            // Enviar a requisição POST com o cabeçalho configurado
                            $response = Http::withHeaders($headers)->post('https://api.iugu.com/v1/payment_token', $dataToken);
                            
                            if ($response->successful()) {
                                $response->json();

                                CardToken::create([
                                    'token_id' => $response['id'],
                                    'card_id' => $cartao->id,
                                ]);

                            } else {
                                // Tratar erro
                                return $response->body();
                            }


                        }
                           
                    $valueCents = $purchase->compra_value * 100;

                    $order_id = Str::uuid();

                    $dataPurchase = [
                        'method' => 'credit_card',
                        'token' => $cartao->token->token_id,
                        'customer_payment_method_i' => '#',                   
                        'email' => $email, 
                        'months' => '#',
                        'items' => [
                            'quantity' => 1,
                            'price_cents' => $valueCents,
                            'id' => $order_id,
                        ],      
                        'order_id' =>  $order_id,
                        'soft_descriptor_light' => $purchase->compra_fatura,
                    ];    

                    $headers = [
                        'Content-Type' => 'application/json',
                        'Origin' => 'https://api.gl-pagamentos.com.br/',
                    ];
                
                    // Enviar a requisição POST com o cabeçalho configurado
                    $response = Http::withHeaders($headers)->post('https://api.iugu.com/v1/charge?api_token={{ VALOR_API }}', $dataToken);
                    if($response->successful()){

                        $purchase->compra_status = 'paga';
                        $purchase->save();

                    }
                    else{
                        // ENVIAR WEBHOOK DE ERRO
                    }
                                        
                }
            }
        }
    }

    private function getSubAccountForPayment()
    {
        // Recupera todas as subcontas
        $subAccounts = AccountIdToken::all();

        // Calcular as faixas de probabilidade cumulativas
        $cumulativeProbability = 0;
        $probabilityRanges = [];

        foreach ($subAccounts as $subAccount) {
            $cumulativeProbability += $subAccount->probability;
            $probabilityRanges[] = [
                'subAccount' => $subAccount,
                'range' => $cumulativeProbability
            ];
        }

        // Gere um número aleatório entre 0 e a soma das probabilidades
        $randomNumber = rand(0, $cumulativeProbability);

        // Determine a subconta com base no número aleatório e nas faixas de probabilidade
        foreach ($probabilityRanges as $entry) {
            if ($randomNumber <= $entry['range']) {
                return $entry['subAccount'];
            }
        }

        // Fallback para a primeira subconta, caso algo dê errado
        return $subAccounts->first();
    }

}