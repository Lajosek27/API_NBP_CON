<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\connectToAPI;
use App\Services\updateCurrencies;
use Doctrine\ORM\EntityManagerInterface;

class UpdateCurrenciesController extends AbstractController
{
    #[Route('/', name: 'app_update_currencies')]
    public function index(connectToAPI $client,EntityManagerInterface $menager): Response
    {
        
        $currenciesFromAPI = $client->getCurrencies();

        $res = new updateCurrencies(
            $currenciesFromAPI,
            $menager
        );
        
        return $this->render('update_currencies/index.html.twig', [
            'res' =>  $res,
        ]);
    }
}
