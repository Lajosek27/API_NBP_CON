<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Currency;

class CurrencyTest extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $currency = new Currency();

        $currency->setName('Polski Złoty');
        $currency->setCurrencyCode('PLN');
        $currency->setExchangeRate(1.0000000);

        $manager->persist($currency);
        $manager->flush();
    }
}
