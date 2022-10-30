<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Partner;
use App\Entity\Structure;
use App\Service\MailService;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * Route pour les structures uniquement avec détail de leurs structures
 */

#[Route('/structure')]

class StructureController extends AbstractController
{
    #[Route('/show/{id<\d+>}', name: 'app_structure_show')]

    public function index(ManagerRegistry $doctrine, int $id): Response
    {

        // $repositoryUser = $doctrine->getRepository(User::class);
        // $userId = $repositoryUser->find($id);
        // $repositoryPartner = $doctrine->getRepository(Partner::class);
        // $partner = $repositoryPartner->find($id);

        $repositoryStructure = $doctrine->getRepository(Structure::class);
        $structure = $repositoryStructure->find($id);
        $permissions = $structure->getPermissions();

        // $structure = $user->getStructure();
        
        return $this->render('structure/index.html.twig',[
            'structure'=> $structure,
            'permissions' => $permissions,

        ]);
    }
    /**
     * Change Email + MDP 
     */
    #[Route('/edit/{id<\d+>}/', name: 'app_structure_edit')]
    public function editUser(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user = null, MailService $mail, StructureRepository $structureRepo): Response
    {
        /**
         * @var User $user 
         */
        $user = $this->getUser();
        if (!$user) {
            $user = new User();
        }
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);

        //S'assure de la validité du form et que les valaurs sont cohérentes
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$user->getId()) {
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
        $structure = $structureRepo->findOneByName($user->getUsername());

        return $this->render('structure/user/editUser.html.twig', [
            'formUser' => $form->createView(),

            //Variable in editMode
            'editMode' => $user->getId() !== null,
            'h1Edit' => $user->getUsername() !== null,
            'structures'=>$structure,
        ]);
    }

}