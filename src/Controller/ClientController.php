<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  
 */

#[Route('/client')]


class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client')]



    public function index(): Response
    {
        return $this->render('client/client.html.twig');
    }


}


