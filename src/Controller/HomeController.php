<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Page d'accueil => btn connexion qui renvoi à /login
 */

#[Route('/')]


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }


}