<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewStructureController extends AbstractController
{
    /**
     * For create structure
    */
    #[Route('/new_structure', name: 'new_structure')]
    public function formNewStructure(Request $request, EntityManagerInterface $entityManager, Structure $structure=null,): Response
    {
        if (!$structure) {
            $structure = new Structure();
        }
        $formStructure = $this->createForm(StructureType::class, $structure);
        $formStructure->handleRequest($request);


        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($formStructure->isSubmitted() && $formStructure->isValid()) {
            // if (!$structure->getId()) {
                
            // }
            // Ajoute des permissions aux structures
            $permissions = $structure->getPermissions();
                foreach ($permissions as $permission){
                    $structure->addPermission($permission);
                }
        
            $entityManager->persist($structure);
            $entityManager->flush();

            $this->addFlash('success', 'La structure a bien été créé');
            
        }
        
        //RECUP NOM PARTNER + STRUCTURE POUR LE MODE EDIT
        $partner = $structure->getPartner();
        return $this->render('admin/structure/newStructure.html.twig', [
            'formStructure' => $formStructure->createView(),

            //Variable in editMode
            'editMode' => $structure->getId() !== null,
            'structure' => $structure,
            'partner'=> $partner,
        ]);
    }


    /**
     * For edit structure
     */
    #[Route('/structure/{id}/edit', name: 'structure_edit')]
    
    public function formEditStructure(Request $request, EntityManagerInterface $entityManager, Structure $structure=null,): Response
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
            // Ajoute des permissions aux structures
            $permissions = $structure->getPermissions();
                foreach ($permissions as $permission){
                    $structure->addPermission($permission);
                }
        
            $entityManager->persist($structure);
            $entityManager->flush();

            $this->addFlash('success', 'La structure a bien été modifié');
            
        }
        
        //RECUP NOM PARTNER + STRUCTURE POUR LE MODE EDIT
        $partner = $structure->getPartner();
        return $this->render('admin/structure/editStructure.html.twig', [
            'formStructure' => $formStructure->createView(),

            //Variable in editMode
            'editMode' => $structure->getId() !== null,
            'structure' => $structure,
            'partner'=> $partner,
        ]);
    }

    /**
     * Display list structures
     */
    #[Route('/structureList', name: 'app_structureList')]
    public function index(StructureRepository $structureRepository, Request $request): Response
    {
        // display how many structures
        $countStructures = $structureRepository->countStructures();
        
        return $this->render('admin/structure/list.html.twig', [
            'titlePage' => 'Liste des structures',
            'structures' => $structureRepository->findAllStructures(),
            'countStructures' => $countStructures,
            'structures'=> $structureRepository->getPaginatedStructure((int) $request->query->get("page")),

        ]);
    }

}