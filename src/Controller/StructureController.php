<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partner;
use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/structure')]


class StructureController extends AbstractController
{
    #[Route('/show/{id<\d+>}', name: 'app_structure_show')]

    public function index(ManagerRegistry $doctrine, int $id): Response
    {

        // $repositoryUser = $doctrine->getRepository(User::class);
        // $userId = $repositoryUser->find($id);
        // $repositoryPartner = $doctrine->getRepository(Partner::class);
        // $partner = $repositoryPartner->find($id);

        $repositoryStructure = $doctrine->getRepository(Structure::class);
        $structure = $repositoryStructure->find($id);
        $permissions = $structure->getPermissions();

        // $structure = $user->getStructure();
        
        return $this->render('structure/index.html.twig',[
            'structure'=> $structure,
            'permissions' => $permissions,

            // 'user'=> $userId,
            // 'partner'=> $partner
        ]);
    }
}