<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class connectToAPI
{   
    
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }


    public function getCurrencies() : array
    {   
        $response = $this->client->request(
            'GET',
            $_ENV['NBP_API_URL'],
            [ 'headers' => [
                'Accept' => 'application/json',
            ],]
        );

        $content = $response->toArray();


        return  $content[0]['rates'];
    }
}
