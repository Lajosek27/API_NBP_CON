<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\connectToAPI;
use App\Services\updateCurrencies;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class UpdateCurrenciesController extends AbstractController
{
    #[Route('/', name: 'app_update_currencies')]
    public function index(connectToAPI $client, EntityManagerInterface $menager, LoggerInterface $logger): Response
    {
        
        $currenciesFromAPI = $client->getCurrencies();

        $updater = new updateCurrencies(
            $currenciesFromAPI,
            $menager,
            $logger
        );
        $res = $updater->doThinks(); 
        return $this->render('update_currencies/index.html.twig', [
            'res' =>  $res,
        ]);
    }
}
