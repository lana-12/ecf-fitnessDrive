<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use App\Service\MailService;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Security("is_granted('ROLE_ADMIN')", statusCode: 403)]
class NewStructureController extends AbstractController
{
    #[Route('/structureList', name: 'app_structureList')]
    public function index(StructureRepository $structureRepository, Request $request): Response
    {
        // display how many structures
        $countStructures = $structureRepository->countStructures();

        return $this->render('admin/structure/list.html.twig', [
            'titlePage' => 'Liste des structures',
            'structures' => $structureRepository->findAllStructures(),
            'countStructures' => $countStructures,
            'structures' => $structureRepository->getPaginatedStructure((int) $request->query->get("page")),

        ]);
    }
   
    #[Route('/new_structure', name: 'new_structure')]
    public function formNewStructure(Request $request, EntityManagerInterface $entityManager, Structure $structure=null, MailService $mail): Response
    {
        if (!$structure) {
            $structure = new Structure();
        }
        $formStructure = $this->createForm(StructureType::class, $structure);
        $formStructure->handleRequest($request);

        if ($formStructure->isSubmitted() && $formStructure->isValid()) {
            $permissions = $structure->getPermissions();
            $entityManager->persist($structure);
            $entityManager->flush();

            $this->addFlash('success', 'La structure a bien été créé');
            
            //sendEmail
            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $structure->getUser()->getEmail(),
                'Activation de votre Structure',
                'registerStructure',
                compact('structure')
            );

            $this->addFlash('send', 'Email d\'Activation a bien été envoyé');

            //sendEmail partner
            $partner = $structure->getPartner();
            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $partner->getUser()->getEmail(),
                'Activation de votre structure',
                'registerStructureOfPartner',
                compact('partner')

            );
            $this->addFlash('send2', 'Email de modification a bien été envoyé à la  franchise');
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

    #[Route('/structure/{id}/edit', name: 'structure_edit')]
    
    public function formEditStructure(Request $request, EntityManagerInterface $entityManager, Structure $structure=null, MailService $mail): Response
    {
        if (!$structure) {
            $structure = new Structure();
        }
        $formStructure = $this->createForm(StructureType::class, $structure);
        $formStructure->handleRequest($request);
        
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

            //sendEmail structure
            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $structure->getUser()->getEmail(),
                'Modification de votre compte',
                'editStructure',
                compact('structure')

            );
            $this->addFlash('send', 'Email de Modification a bien été envoyé à la structure');

            //sendEmail partner
            $partner = $structure->getPartner();
            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $partner->getUser()->getEmail(),
                'Modification de votre structure',
                'editStructureOfPartner',
                compact('partner')
            );
            $this->addFlash('send2', 'Email de modification a bien été envoyé à la  franchise');
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

}