<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewStructureController extends AbstractController
{
    #[Route('/new_structure', name: 'new_structure')]
    #[Route('/structure/{id}/edit', name: 'structure_edit')]

    /**
     * For create and edit structure
     */

    public function formStructure(Request $request, EntityManagerInterface $entityManager, Structure $structure=null,): Response
    {
        if (!$structure) {
            $structure = new Structure();
        }
        $formStructure = $this->createForm(StructureType::class, $structure);
        $formStructure->handleRequest($request);


        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($formStructure->isSubmitted() && $formStructure->isValid()) {
            if (!$structure->getId()) {
                
            }

            $entityManager->persist($structure);
            $entityManager->flush();

            // $this->addFlash('success', 'Message envoyé');
            
            return $this->render('structure/structure.html.twig', [
                'structure'=> $structure,

            ]);
        }
        //RECUP NOM PARTNER + STRUCTURE DS EDIT
        $partner = $structure->getPartner();
        return $this->render('admin/formStructure.html.twig', [
            'formStructure' => $formStructure->createView(),

            //Variable in editMode
            'editMode' => $structure->getId() !== null,
            'structure' => $structure,
            'partner'=> $partner,
        ]);
    }
}