<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\connectToAPI;

class UpdateCurrenciesController extends AbstractController
{
    #[Route('/', name: 'app_update_currencies')]
    public function index(connectToAPI $client): Response
    {
        
        $res = $client->getCurrencies();


        return $this->render('update_currencies/index.html.twig', [
            'controller_name' => 'UpdateCurrenciesController',
        ]);
    }
}
