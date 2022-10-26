<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NewPartnerController extends AbstractController
{
    /**
     * For create and edit partner
    */
    #[Route('/newpartner', name: 'new_partner')]
    #[Route('/partner/{id}/edit', name: 'partner_edit')]

    public function formpartner(Request $request, EntityManagerInterface $entityManager, Partner $partner=null, PartnerRepository $partnerRepo ): Response
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
            
            $this->addFlash('success', 'La Franchise a bien été créer');
            
            // return $this->render('admin/index.html.twig',[
                // 'partners'=>
                // $partnerRepo->getPaginatedPartner((int) $request->query->get("page")),
            // ]);
            
            }

            return $this->render('admin/partner/formPartner.html.twig',[
                'formpartner'=>$formPartner->createView(),

            //Variable in editMode
            'editMode'=> $partner->getId() !== null,
            'partner' => $partner,

        ]);
    }

}