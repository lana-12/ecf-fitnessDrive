<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NewPartnerController extends AbstractController
{
    #[Route('/newpartner', name: 'new_partner')]
    #[Route('/{id}/edit', name: 'partner_edit')]
    /**
     * For create NewPartner
     */

    public function formpartner(Request $request, EntityManagerInterface $entityManager,Partner $partner=null, ManagerRegistry $doctrine, ): Response
    {  
            
            if(!$partner){
                $partner = new Partner();
            }
            $formPartner = $this->createForm(PartnerType::class, $partner);
            $formPartner->handleRequest($request);

        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($formPartner->isSubmitted() && $formPartner->isValid()){
            if(!$partner->getId()){
                
            }

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
            $nameP = $partner->getNamePartner();
        
        return $this->render('admin/formPartner.html.twig',[
            'formpartner'=>$formPartner->createView(),

            //Variable in editMode
            'editMode'=> $partner->getId() !== null,
            // Ne marche pas display I
            'h3Edit'=> $nameP !== null,

        ]);
    }
    
}


