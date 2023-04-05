<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Services\connectToAPI;

class connectToAPI
{   
    
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function getCurrencies() 
    {   
        
       
       
    }
}
