<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CrawlerService;

class CrawlerController extends Controller
{
    protected $crawlerService;

    public function __construct(CrawlerService $crawlerService)
    {
        $this->crawlerService = $crawlerService;
    }

    public function submit(Request $request)
    {
        $url = 'https://www.clara.com/pt-br/signup';

        // Dados do formulário que você quer enviar
        $formData = [
            'email' => 'email',
            'phone' => 'phone',
            'LEGAL_CONSENT.subscription_type_10066286' => 'true'
        ];

        $response = $this->crawlerService->submitForm($url, $formData);

        // Retorne a resposta ou faça outra lógica
        return response()->json(['response' => $response]);
    }
}
