<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerService
{
    protected $client;

    public function __construct()
    {
        // Crie o cliente Guzzle com um User-Agent padrão
        $this->client = new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'  // Substitua pelo User-Agent desejado
            ]
        ]);
    }

    public function submitForm($url, $formData)
    {
        // Faz uma requisição GET para obter o conteúdo da página
        $response = $this->client->request('GET', $url);
        $html = $response->getBody()->getContents();

        dd($html);

        // Use o DomCrawler para analisar o HTML com a URL base
        $crawler = new Crawler($html, $url);

        // Depure e verifique o conteúdo do HTML do formulário
        $formHtml = $crawler->filter('form')->html();
        // dd($formHtml); // Descomente para depurar

        // Encontre o primeiro formulário na página
        $form = $crawler->filter('form')->first()->form();

        // Preencha o formulário com os dados fornecidos
        $response = $this->client->post($url, [
            'form_params' => $formData
        ]);

        // Faça algo com a resposta
        $responseText = (string) $response->getBody();

        return $responseText;
    }
}
