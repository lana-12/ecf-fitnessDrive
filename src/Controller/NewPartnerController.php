<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/partner')]

class NewPartnerController extends AbstractController
{
    // #[Route('/', name: 'app_user')]
    // public function index(): Response
    // {
    //     return $this->render('user/index.html.twig');

    // }

    #[Route('/new', name: 'app_partner_new')]

    /**
     * For create NewPartner
     */

    public function formpartner(Request $request, EntityManagerInterface $entityManager, PartnerRepository $partnerRepository): Response
    {
        $partner = new Partner();
        
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);
        
        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($form->isSubmitted() && $form->isValid()){
            
            $partnerRepository->add($partner, true);
            $entityManager->persist($partner);
            $entityManager->flush();
            
            
            
            
            // $this->addFlash('success', 'Message envoyé');
            return $this->render('partner/partner.html.twig',[
                'partner'=> $partner,
                
            ]);
            
            // dd($partner);
            
            // pour afficher la suite sur une autre page
            //pour l'instant j'ai afficher
            // return $this->render('user/index.html.twig',[
                //     'user'=> $partner,
                
                // ]);
            }
        
        return $this->render('partner/formPartner.html.twig',[
            'formpartner'=>$form->createView(),

        ]);

        

    }

    #[Route('/success', name: 'app_user_success')]
    public function success(): Response
    {
        return $this->render('user/index.html.twig');

    }


    
    
}


