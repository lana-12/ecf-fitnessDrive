<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Structure;
use App\Entity\User;
use App\Repository\StructureRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Route pour les franchises uniquement avec détail de leurs structures
 */

#[Route('/partner')]

class PartnerController extends AbstractController
{
    #[Route('/show/{id<\d+>}', name: 'app_partner_show')]



    public function index(ManagerRegistry $doctrine, int $id, StructureRepository $structureRepository, UserRepository $userRepository, User $userRole, Partner $partner): Response
    {
        // Method with ManagerRegistry => recup all the partner {$id}
        $repositoryPartner = $doctrine->getRepository(Partner::class);
        $partner = $repositoryPartner->find($id);

        //Methode avec StructureRepository => recup tt les structures du partner
        // error methode display partner en boucle
        $structures = $structureRepository->findAllStructuresByPartner($id);
        // $structures= $partner->getStructures();
            

        $repoUser =$doctrine->getRepository(User::class);
        $user = $repoUser->find($id);
        // dump($user);


        // $role = $userRole->getRoles();
        // $partnerRole = $userRepository->findByRole($role);
        // $id = $userRole->getId();

        // dump($role);
        // dump($id);
        // dump($partnerRole);
        // $users = $userRepository->findBy($id);
        // dump($users);

            return $this->render('partner/index.html.twig',[
                'partner'=> $partner,
                'structures' => $structures,
                // 'role'=> $partnerRole,
                // 'id'=> $id,
                // 'error'=> 'Oups une erreur est survenue !'

            ]);
    }

    #[Route('/structure/show/{id}', name: 'app_structure/show')]
    public function showStructure(ManagerRegistry $doctrine, int $id) : Response
    {
            $repository = $doctrine->getRepository(Structure::class);
            $structure = $repository->find($id);
            
            $permissions = $structure->getPermissions();

        return $this->render('partner/structure.html.twig',[
            'structure' => $structure,
            'permissions' => $permissions,

        ]);

    }

}