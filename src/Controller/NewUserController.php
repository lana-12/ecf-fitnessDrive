<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\MailService;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
class NewUserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $userPasswordHasher;
    private MailService $mailService;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher, MailService $mailService)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordHasher = $userPasswordHasher;
        $this->mailService = $mailService;
    }


    #[Security("is_granted('ROLE_ADMIN')", statusCode: 403)]
    #[Route('/list', name: 'app_user_list')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $page = (int) $request->query->get('page', 1);
        $users = $userRepository->getPaginatedUser($page);
        $filteredUsers = [];

        foreach ($users as $user) {
            if (!in_array('ROLE_ADMIN', $user->getRoles(), true)) {
                $filteredUsers[] = $user;
            }
        }

        return $this->render('admin/user/index.html.twig', [
            'titlePage' => 'Liste de Compte de connexion',
            'countUsers' => $userRepository->countUsers(),
            'users' => $filteredUsers,
        ]);
    }


    

    #[Route('/new', name: 'user_new')]

    /**
     * For create and Edit NewUser 
     */

    public function formUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user=null, MailService $mail): Response
    {
        if(!$user){
            $user = new User();
        }
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        
        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($form->isSubmitted() && $form->isValid()){
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,

                    // pour modifier son mot de passe
                    //récup les données saisies par l'utilisateur.
                    $form->get('password')->getData()
                )
            );
            // Ajoute des partners aux user
            $partners = $user->getPartner();
            foreach ($partners as $partner) {
                $user->addPartner($partner);
            }
            // Ajoute des structures aux user
            $structures = $user->getStructure();
            foreach ($structures as $structure) {
                $user->addStructure($structure);
            }
            
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash('success', 'Le compte de connexion a bien été créé');

            //sendEmail
            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $user->getEmail(),
                'Activation de votre compte',
                'registerUser',
                compact('user')

            );

            $this->addFlash('send', 'Email d\'Activation a bien été envoyé');

        }
        
        return $this->render('admin/user/userNew.html.twig',[
            'titlePage'=> 'Créer un nouvel Utilisateur',
            'formUser'=>$form->createView(),
        ]);
    }

    
    /**
     * For Edit NewUser 
     */
    #[Route('/{id<\d+>}/edit', name: 'user_edit')]
    public function editUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user=null, MailService $mail ): Response
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
            // Ajoute des partners aux user
            $partners = $user->getPartner();
            foreach ($partners as $partner) {
                $user->addPartner($partner);
            }

            // Ajoute des structures aux user
            $structures = $user->getStructure();
            foreach ($structures as $structure) {
                $user->addStructure($structure);
            }
            
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash('success', 'Le compte de connexion a bien été modifié');

            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $user->getEmail(),
                'Modification de votre compte',
                'editUser',
                compact('user')

            );
            $this->addFlash('send', 'Email de modification a bien été envoyé');

        }
        
        return $this->render('admin/user/editUser.html.twig',[
            'formUser'=>$form->createView(),

            //Variable in editMode
            'editMode'=> $user->getId() !== null,
            'h1Edit'=> $user->getUsername() !== null,
        ]);
    }

   
    
    
}