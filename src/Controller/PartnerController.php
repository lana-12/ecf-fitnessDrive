<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  
 */

#[Route('/partner')]


class PartnerController extends AbstractController
{
    #[Route('/', name: 'app_partner')]



    public function index(): Response
    {
        return $this->render('partner/partner.html.twig');
    }


}


