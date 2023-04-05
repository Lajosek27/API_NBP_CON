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

    /**
     * Main methode. Contains logic to save or update currency and all log.
     *
     * @return void
     */
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
                $this->logger->info('Istnieje w DB: '. $row['currency']);
                $update = $this->update($row);
                $update ? $this->logger->info('Zaktualizowano kurs: '. $row['currency']) :  $this->logger->info('Nie aktualizowano kursu: '. $row['currency']);
            }
        }

       
    }

    /**
     * Update in database exchance_rate 
     *
     * @param array $row  one from currency from public methode saveToDB()
     * @return bool
     */
    private function update($row) : bool 
    {
        $currency = $this->getCurrencyByCode($row['code']);

        if($currency)
        {
            $currency->setExchangeRate($row['mid']);
            $this->manager->flush();
        }

        $currency = $this->getCurrencyByCode($row['code']);

        return $currency->getExchangeRate() == $row['mid'] ? true : false;
    }

    /**
     * Check if currency exist base od unique currency_code 
     *
     * @param string $code - string(3) 
     * @return bool
     */
    private function isInDatebase(string $code) : bool
    {   
        $exist = $this->getCurrencyByCode($code);
        return  isset($exist) ;
    }

    /**
     * Add currency to DB
     *
     * @param array $data one from currency from public methode saveToDB()
     * @return bool 
     */
    private function addToDB(array $data) : bool
    {
        $currency = new Currency();
        $currency->setName($data['currency']);
        $currency->setCurrencyCode($data['code']);
        $currency->setExchangeRate($data['mid']);
        
        $this->manager->persist($currency);
        
        $this->manager->flush();
        
        return $bool = $this->isInDatebase($data['code']);
    }

    /**
     * Get currency form database by unique code 
     *
     * @param string $code - string(3)
     * @return Currency
     */
    private function getCurrencyByCode(string $code) : Currency 
    {
        return $this->manager->getRepository(Currency::class)->findOneBy(['currency_code' => $code]);
    }
} 
