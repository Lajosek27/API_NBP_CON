<?php

namespace App\Services;


use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;


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
        private EntityManagerInterface $manager,
        private LoggerInterface $logger
    ) {
    }


    public function doThinks() 
    {   
        
        foreach ($this->currencies as $row)
        {
            $exist = $this->isInDatebase($row["code"]);

            if(!$exist)
            {
                $this->logger->info('Nie istnieje w DB: '. $row["code"]);
            }else
            {
                $this->logger->info('Istnieje w DB: '. $row["code"]);
            }
        }

        return true;
       
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
