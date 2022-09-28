<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\UserRepository;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/newpartner')]

class NewPartnerController extends AbstractController
{
    // #[Route('/', name: 'app_user')]
    // public function index(): Response
    // {
    //     return $this->render('user/index.html.twig');

    // }

    #[Route('/', name: 'app_new_partner')]

    /**
     * For create NewPartner
     */

    public function formpartner(Request $request, EntityManagerInterface $entityManager, $partner=null,): Response
    {
            if(!$partner){
                $partner = new Partner();
            }
            $formPartner = $this->createForm(PartnerType::class, $partner);
            $formPartner->handleRequest($request);
            
            // le haschage ne marche pas

        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($formPartner->isSubmitted() && $formPartner->isValid()){
            
            $entityManager->persist($partner);
            $entityManager->flush();
            
            
            
            // $this->addFlash('success', 'Message envoyé');
            return $this->render('partner/partner.html.twig',[
                'partner'=> $partner,
                
            ]);
            
            
            // pour afficher la suite sur une autre page
            //pour l'instant j'ai afficher
            // return $this->render('user/index.html.twig',[
                //     'user'=> $partner,
                
                // ]);
            }
        
        return $this->render('admin/formPartner.html.twig',[
            'formpartner'=>$formPartner->createView(),

        ]);

        

    }

    #[Route('/success', name: 'app_user_success')]
    public function success(): Response
    {
        return $this->render('user/index.html.twig');

    }


    
    
}


