<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partner;
use App\Entity\Structure;
use App\Repository\UserRepository;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]

    public function index(ManagerRegistry $doctrine, PartnerRepository $partnerRepository, StructureRepository $structureRepository): Response
    {
        // $repository = $doctrine->getRepository(Partner::class);
        // $partners = $repository->findAll();

        // $repository = $doctrine->getRepository(Structure::class);
        // $structures = $repository->findAll();
/**
 * @var User $user 
 */
        $user= $this->getUser();
        if (in_array('ROLE_PARTNER', $user->getRoles()) ){
            $status = $partnerRepository->findOneByName($user->getUsername());
            $id = $status[0]->getId();
        }
        if (in_array('ROLE_STRUCTURE', $user->getRoles()) ){
            $status = $structureRepository->findOneByName($user->getUsername());
            $id = $status[0]->getId();
        }
        if (in_array('ROLE_ADMIN', $user->getRoles()) ){
            // $status = $user->getUsername();
            $id = $user->getId();
        }
            
        
        return $this->render('home/index.html.twig',[
            'user'=> $user,
            // 'partner'=> $partners,
            // 'structure'=> $structures,
            'id'=> $id,
            
        ]);
    }


}