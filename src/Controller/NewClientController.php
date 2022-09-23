<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/client')]

class NewClientController extends AbstractController
{
    // #[Route('/', name: 'app_user')]
    // public function index(): Response
    // {
    //     return $this->render('user/index.html.twig');

    // }

    #[Route('/new', name: 'app_client_new')]

    /**
     * For create NewClient
     */

    public function formClient(Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository): Response
    {
        $client = new Client();
        
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        
        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($form->isSubmitted() && $form->isValid()){
            
            $clientRepository->add($client, true);
            $entityManager->persist($client);
            $entityManager->flush();
            
            
            
            
            // $this->addFlash('success', 'Message envoyé');
            return $this->render('client/client.html.twig',[
                'client'=> $client,
                
            ]);
            
            // dd($client);
            
            // pour afficher la suite sur une autre page
            //pour l'instant j'ai afficher
            // return $this->render('user/index.html.twig',[
                //     'user'=> $client,
                
                // ]);
            }
        
        return $this->render('client/formClient.html.twig',[
            'formClient'=>$form->createView(),

        ]);

        

    }

    #[Route('/success', name: 'app_user_success')]
    public function success(): Response
    {
        return $this->render('user/index.html.twig');

    }


    
    
}


