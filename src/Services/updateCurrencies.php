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


    public function saveToDB() 
    {   
        
        foreach ($this->currencies as $row)
        {
            $exist = $this->isInDatebase($row["code"]);

            if(!$exist)
            {
                $this->logger->info('Nie istnieje w DB: '. $row['currency']);
                $added = $this->addToDB($row);
                $added ? $this->logger->info('Pomyślnie dodano do Bazy damych '.$row['currency']) : $this->logger->error('Błąd poczas dodawania '.$row['currency']);
           
            }else
            {

                $this->logger->info('Istnieje w DB: '. $row["code"]);
            }
        }

        return true;
       
    }

    private function update($row)
    {
        // ...
    }


    private function isInDatebase(string $code)
    {   
        $exist = $this->manager->getRepository(Currency::class)->findOneBy(['currency_code' => $code]);
        return  isset($exist) ;
    }

    /**
     * Add currency to DB
     *
     * @param array $data contains one from currency from public methode saveToDB()
     * @return bool 
     */
    private function addToDB(array $data) 
    {
        $currency = new Currency();
        $currency->setName($data['currency']);
        $currency->setCurrencyCode($data['code']);
        $currency->setExchangeRate($data['mid']);
        
        $this->manager->persist($currency);
        
        $this->manager->flush();
        
        return $bool = $this->isInDatebase($data['code']);
    }
  
} 
