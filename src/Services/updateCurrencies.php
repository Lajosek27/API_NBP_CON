<?php

namespace App\Services;


use App\Entity\Currency;


class updateCurrenciesService 
{   
    
    public function __construct(
        private array $currencies,
    ) {
    }


    public function doThinks() 
    {   
        
        

        return '__Ukończono__';
       
    }

    public function update($row)
    {
        // ...
    }


    public function isInDatebase(string $code)
    {   
         // ...
    }

    private function addToDB(array $data) 
    {
         // ...
    }
  
} 
