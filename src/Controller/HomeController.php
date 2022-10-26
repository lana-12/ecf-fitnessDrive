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

        $users= $this->getUser();
        
        $partner = $partnerRepository->findOneByName($this->getUser()->getUsername());

        $structure = $structureRepository->findOneByName($this->getUser()->getUsername());
        
        // mercredi 26 octobre 23:41 =>ok role

        
        return $this->render('home/index.html.twig',[
            'user'=> $users,
            // 'partner'=> $partners,
            // 'structure'=> $structures,
            'partners'=> $partner,
            'structures'=> $structure
        ]);
    }


}