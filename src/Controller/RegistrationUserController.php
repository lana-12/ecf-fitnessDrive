<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationUserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user', name: 'app_user')]

class RegistrationUserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');

    }


    #[Route('/new', name: 'app_user_new')]

    public function new(Request $request): Response
    {
        $user = new User();
        $formUser = $this->createForm(RegistrationUserType::class, $user);

        //Mise à jour Objet $formUser avec les valeurs saisie
        $formUser->handleRequest($request);

        //S'assure de la validitédu form et que les valaurs sont cohérentes
        if ($formUser->isSubmitted() && $formUser->isValid()){
            // dd($formUser->getData());
            dd($user);
            
            // return $this->redirectToRoute('app_user');
            }
            // return $this->renderForm('registration/registrationUser.html.twig', [
            //     'form' => $formUser,
            // ]);
        return $this->render('registration/registrationUser.html.twig');

    }


    // #[Route('/user', name: 'app_user')]
    // public function createUser(ManagerRegistry $doctrine): Response
    // {
    //     $user = new User();
    //     $user->setUsername('Admin1');
    //     $user->setEmail('email@example.com');
    //     $user->setPassword('monMotDePasseEnClair');
    //     $user->setRole('admnin');
        
    //     $entityManager = $doctrine->getManager();

    //     // save the Product 
    //     $entityManager->persist($user);

    //     // executes the queries (insert into user )
    //     $entityManager->flush();

    //     return $this->render('user/index.html.twig', [
    //         'controller_name' => 'UserController',

    //         'id'=> $user->getId(),
    //         'username'=> $user->getUsername(),
    //         'email'=> $user->getEmail(),
    //         'password'=> $user->getPassword(),
    //         'role'=> $user->getRole(),
    //     ]);
    // }


    // #[Route('/user/findUser', name: 'app_user_find')]
    // public function findUser(UserRepository $userRepository): Response
    // {
    //     // Retourne un tableau avec tous les users en base de données
    //     // dump ($userRepository->findAll());

    //     // // Retourne un tableau avec tous les users qui ont cet email et ce username
    //     // dump($userRepository->findBy([
    //     //     'email' => 'email1@example.com',
    //     //     'username' => 'Admin1',
    //     // ]));
        

    //     // Méthode magique qui retourne un tableau avec tous les users qui ont cet email
    //     // dump($userRepository->findByEmail('email3@example.com'));

    
    //     // Retourne l'entité User d'id 1
    //     //     $user = $userRepository->find(24);
    //     // dump($user->getUsername());

        
        
    //     // Retourne la première entité User trouvée ayant cet email et ce username
    //     // $user = $userRepository->findOneBy([
    //     //         'email' => 'email4@example.com',
    //     //         'username' => 'Admin4',
    //     //     ]);
        
        
    //     // Méthode magique qui retourne la première entité User trouvée ayant cet email
    //     // $user = $userRepository->findOneByEmail('email4@example.com');
        
    //     // dump($user);
            
    //         $user = $userRepository->findByWithQueryBuilder('admin1');
            
    //         dump($user);
    //         if (!$user){
    //             throw $this->createNotFoundException('unknown user');
    //         }
    //     return new Response('<body></body>');

    // }


    
}


