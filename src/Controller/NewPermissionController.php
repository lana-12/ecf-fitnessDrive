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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Security("is_granted('ROLE_ADMIN')", statusCode: 403)]
class NewPermissionController extends AbstractController
{
    
    #[Route('/permission', name: 'app_permission')]
    public function index(PermissionRepository $permissionRepository, Request $request): Response
    {
        $countPermissions = $permissionRepository->countPermissions();


        return $this->render('admin/permission/index.html.twig', [
            'titlePage' => 'Liste des permissions',
            'permissions' => $permissionRepository->findAllPermissions(),
            'countPermissions' => $countPermissions,
            'permissions' => $permissionRepository->getPaginatedPermission((int) $request->query->get("page")),

        ]);
    }


    #[Route('/new', name: 'app_permission_new')]
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
            
            $this->addFlash('success', 'La permission a été créé');

        }
            
        return $this->render('admin/permission/newPermission.html.twig', [
            'titlePage' => 'Créer une nouvelle Permission',
            'formPermission' => $formPermission->createView(),

            //Variable in editMode
            'editMode' => $permission->getId() !== null,
            'permission' => $permission,
        ]);
    }


   
    #[Route('/{id}/edit', name: 'app_permission_edit')]
    public function editPermission(Request $request, EntityManagerInterface $entityManager, Permission $permission = null, ManagerRegistry $doctrine): Response
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
            
            $this->addFlash('success', 'La permission a été modifié');

        }
            
        return $this->render('admin/permission/editPermission.html.twig', [
            'formPermission' => $formPermission->createView(),
            'titlePage' => 'Modifier une nouvelle Permission',

            //Variable in editMode
            'editMode' => $permission->getId() !== null,
            'permission' => $permission,
        ]);
    }

}