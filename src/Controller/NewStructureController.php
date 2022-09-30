<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Structure;
use App\Form\StructureType;
use App\Repository\structureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/new_structure')]

class NewStructureController extends AbstractController
{
    
    #[Route('/', name: 'new_structure')]

    /**
     * For create NewStructure
     */

    public function formStructure(Request $request, EntityManagerInterface $entityManager, $structure=null,): Response
    {
            if(!$structure){
                $structure = new Structure();
            }
            $formStructure = $this->createForm(StructureType::class, $structure);
            $formStructure->handleRequest($request);
            
            // le haschage ne marche pas

        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($formStructure->isSubmitted() && $formStructure->isValid()){
            

            $entityManager->persist($structure);
            $entityManager->flush();
            
            
            
            
            // $this->addFlash('success', 'Message envoyé');
            return $this->render('structure/structure.html.twig',[
                'structure'=> $structure,
                
            ]);
            
            
            }
        
        return $this->render('admin/formStructure.html.twig',[
            'formStructure'=>$formStructure->createView(),

        ]);

        

    }

    #[Route('/success', name: 'app_user_success')]
    public function success(): Response
    {
        return $this->render('user/index.html.twig');

    }


    
    
}


