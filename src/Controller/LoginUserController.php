<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * loginUser home page
 */


class LoginUserController extends AbstractController
{
    #[Route('/', name: 'app_login')]

    public function index(): Response
    {
        return $this->render('loginUser/index.html.twig');
    }

    
    #[Route('/data', name: 'app_default/data')]
    public function test(): Response
    {
        // $pdo = new DataBaseMySQL('fitness_drive', 'localhost', 'root', '');
        // $reqRole = $pdo->getPDO()->query('SELECT * FROM roles', PDO::FETCH_OBJ);
        // $roles = $reqRole->fetchAll();
        // // // // dump($roles);
        
        // echo '<h1>Liste des Rôles : </h1>';
        // echo '<ul>';
        // foreach ($roles as $role) {
        //     echo '<li>';
        //     echo $role->name .'<br>';
        //     echo '</li>';
        // }
        return $this->render('test.html.twig', [ 
        ]);
    }

}


