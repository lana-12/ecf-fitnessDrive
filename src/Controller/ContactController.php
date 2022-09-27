<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  
 */

#[Route('/contact')]


class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact')]



    public function index(): Response
    {
        return $this->render('contact/contact.html.twig');
    }


}


