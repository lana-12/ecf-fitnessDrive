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
    public function index(PartnerRepository $partnerRepository, StructureRepository $structureRepository): Response
    {
        /**
         * @var User $user 
         */
        
        $user= $this->getUser();

        if (in_array('ROLE_PARTNER', $user->getRoles()) ){
            $id = $user->getId();
            $partners = $partnerRepository->findByUserId($id);
            foreach ($partners as $partner) {
                if($partner->getUser()->getId() === $id){
                    return $this->redirectToRoute('app_partner_show', ['id'=> $partner->getId()]);
                }
            }
        }

        if (in_array('ROLE_STRUCTURE', $user->getRoles()) ){
            $id = $user->getId();

            $strutures = $structureRepository->findByUserId($id);
            foreach ($strutures as $struture) {
                if ($struture->getUser()->getId() === $id) {
                    return $this->redirectToRoute('app_structure_show', ['id' => $struture->getId()]);
                }
            }
            
        }
        
        return $this->render('home/index.html.twig',[
            'user'=> $user,
            'id'=> $id,
        ]);
    }


}