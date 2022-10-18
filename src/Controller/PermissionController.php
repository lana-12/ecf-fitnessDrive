<?php

// namespace App\Controller;

// use App\Entity\Permission;
// use Doctrine\Persistence\ManagerRegistry;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class PermissionController extends AbstractController
// {
//     #[Route('/permission', name: 'app_permission')]
//     public function index(ManagerRegistry $doctrine): Response
//     {

//         // $repository = $doctrine->getRepository(Permission::class);
//         // $structure = $repository->findAll();
        
//         return $this->render('permission/index.html.twig', [
//             'controller_name' => 'PermissionController',
//             // 'structure'=> $structure
//         ]);
//     }
// }