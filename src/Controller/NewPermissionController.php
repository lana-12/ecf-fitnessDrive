<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Form\PermissionType;
use App\Repository\PermissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class NewPermissionController extends AbstractController
{
    #[Route('/permission', name: 'app_permission')]
    public function index(PermissionRepository $permissionRepository): Response{
        

        return $this->render('permission/index.html.twig', [
            'permissions' => $permissionRepository->findAllPermissions()
        ]);
    }
    
    #[Route('/new', name: 'app_permission_new')]
    #[Route('/{id}/edit', name: 'app_permission_edit')]
    
    public function newPermission(Request $request, EntityManagerInterface $entityManager, Permission $permission = null, ManagerRegistry $doctrine): Response
    {
        if (!$permission) {
            $permission = new Permission();
        }
        $formPermission = $this->createForm(PermissionType::class, $permission);
        $formPermission->handleRequest($request);

        if ($formPermission->isSubmitted() && $formPermission->isValid()) {
            if(!$permission->getId()){
            
            }

            $entityManager->persist($permission);
            $entityManager->flush();
            
            $this->addFlash('success', 'La permission a été créer');
        }
            
        return $this->render('permission/formPermission.html.twig', [
            'formPermission' => $formPermission->createView(),

            //Variable in editMode
            'editMode' => $permission->getId() !== null,
            'permission' => $permission,
        ]);
    }

    
    // public function edit(PermissionRepository $permissionRepository): Response
    // {
        

    //     return $this->render('permission/index.html.twig', [
    //         'permissions' => $permissionRepository->findAllPermissions(),
            
            
    //     ]);
    // }


    
}