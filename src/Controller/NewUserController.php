<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]

class NewUserController extends AbstractController
{
    #[Route('/new', name: 'user_new')]
    #[Route('/{id}/edit', name: 'user_edit')]

    /**
     * For create and Edit NewUser 
     */

    public function formUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user=null, ): Response
    {
        if(!$user){
            $user = new User();
        }
        $form = $this->createForm(UserType::class, $user);
        
        
        $form->handleRequest($request);
        
        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($form->isSubmitted() && $form->isValid()){
            if(!$user->getId()){
                
            }
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,

                    // pour modifier son mot de passe
                    //récup les données saisies par l'utilisateur.
                    $form->get('password')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash('success', 'La compte de connexion a bien été créer');

            return $this->render('admin/user/list.html.twig',[
                'user'=> $user,
                
            ]);
        }
        
        return $this->render('admin/user/formUser.html.twig',[
            'formUser'=>$form->createView(),

            //Variable in editMode
            'editMode'=> $user->getId() !== null,
            'h1Edit'=> $user->getUsername() !== null,
        ]);
    }

    /**
     * Display list Users
    */
    #[Route('/list', name: 'app_user_list')]
    public function index(UserRepository$userRepository ): Response
    {
        return $this->render('admin/user/list.html.twig',[
            'users'=> $userRepository->findAll(),
            'users'=>$userRepository->getPaginatedUser(1),
        ]);
    }
    
}