<?php

namespace App\Services;


use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;

class updateCurrencies
{   
    /**
     * @param $currencies two-dimensional array with currencies
     *        second lv structure: 
     *          "currency" => name (string 50)
     *          "code" => currency_code (string 4)
     *          "mid" => exchance_rate (decimal (11,9))
     */
    public function __construct(
        private array $currencies,
        private EntityManagerInterface $manager
    ) {
    }


    public function doThinks() 
    {   
        
        foreach ($this->currencies as $row)
        {
            $exist = $this->isInDatebase($row["code"]);
        }

        return $exist;
       
    }

    public function update($row)
    {
        // ...
    }


    public function isInDatebase(string $code)
    {   
        $exist = $this->manager->getRepository(Currency::class)->findOneBy(['currency_code' => $code]);
        return  isset($exist) ;
    }

    private function addToDB(array $data) 
    {
         // ...
    }
  
} 
