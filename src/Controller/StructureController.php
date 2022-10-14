<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/structure')]


class StructureController extends AbstractController
{
    #[Route('/show/{id<\d+>}', name: 'app_structure_show')]

    public function index(int $id): Response
    {

        
        
        return $this->render('structure/index.html.twig'[]);
    }
}