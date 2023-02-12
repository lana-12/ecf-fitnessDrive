<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Service\MailService;
use Symfony\Component\Mime\Email;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NewPartnerController extends AbstractController
{
    /**
     * For create partner
    */
    #[Route('/newpartner', name: 'new_partner')]

    public function formNewPartner(Request $request, EntityManagerInterface $entityManager, Partner $partner=null, MailService $mail): Response
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

            // Ajoute les structures aux partners
            $structures = $partner->getStructures();
            foreach ($structures as $structure) {
                $partner->addStructure($structure);
            }
            
            $entityManager->persist($partner);
            $entityManager->flush();
            
            $this->addFlash('success', 'La Franchise a bien été créé');
            
            //sendEmail
            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $partner->getUser()->getEmail(),
                'Activation de votre compte',
                'registerPartner',
                compact('partner')
                
            );
            
            $this->addFlash('send', 'Email d\'Activation a bien été envoyé');
            }
            
            return $this->render('admin/partner/newPartner.html.twig',[
                'formpartner'=>$formPartner->createView(),

                //Variable in editMode
                'editMode'=> $partner->getId() !== null,
                'partner' => $partner,

        ]);
    }
    
    /**
     * For edit partner
    */
    #[Route('/partner/{id}/edit', name: 'partner_edit')]

    public function formEditPartner(Request $request, EntityManagerInterface $entityManager, Partner $partner=null, MailService $mail, PartnerRepository $partnerRepo ): Response
    {  
            if(!$partner){
                $partner = new Partner();
            }
            $formPartner = $this->createForm(PartnerType::class, $partner);
            $formPartner->handleRequest($request);
            $email = $partner->getUser()->getEmail();
        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($formPartner->isSubmitted() && $formPartner->isValid()){
            if(!$partner->getId()){
                
            }

            // Ajoute les structures aux partners
            $structures = $partner->getStructures();
            foreach ($structures as $structure) {
                $partner->addStructure($structure);
            }
            
            $entityManager->persist($partner);
            $entityManager->flush();
            
            $this->addFlash('success', 'La Franchise a bien été Modifier');
            

            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $partner->getUser()->getEmail(),
                'Modification de votre compte',
                'editPartner',
                compact('partner')
                
            );
            $this->addFlash('send', 'Email de modification a bien été envoyé');
            
        }
        
            return $this->render('admin/partner/editPartner.html.twig',[
                'formpartner'=>$formPartner->createView(),

                //Variable in editMode
                'editMode'=> $partner->getId() !== null,
                'partner' => $partner,

        ]);
    }

}
