<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Partner;
use App\Entity\Structure;
use App\Service\MailService;
use App\Repository\UserRepository;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * Route pour les franchises uniquement avec détail de leurs structures
 */

#[Route('/partner')]

class PartnerController extends AbstractController
{
    #[Route('/show/{id<\d+>}', name: 'app_partner_show')]

    public function index(ManagerRegistry $doctrine, int $id, Partner $partner, PartnerRepository $partnerRepo): Response
    {
        // Method with ManagerRegistry => recup all the partner {$id}
        $repositoryPartner = $doctrine->getRepository(Partner::class);
        $partner = $repositoryPartner->find($id);
        
        //2 Methodes => recup tt les structures du partner
        //avec StructureRepository
        // $structures = $structureRepository->findAllStructuresByPartner($id);
        $structures= $partner->getStructures();
        
        $repositoryS = $doctrine->getRepository(Structure::class);
        $structure = $repositoryS->find($id);

        $permissions = $structure->getPermissions();

            return $this->render('partner/index.html.twig',[
                'partner'=> $partner,
                'structures' => $structures,
                'permissions'=> $permissions,
            ]);
    }

    #[Route('/structure/show/{id<\d+>}', name: 'app_partner_structure_show')]
    public function showStructure(ManagerRegistry $doctrine, int $id) : Response
    {
        $repositoryS = $doctrine->getRepository(Structure::class);
        $structure = $repositoryS->find($id);
        
        $partner = $structure->getPartner();

        $permissions = $structure->getPermissions();

        return $this->render('partner/structure.html.twig',[
            'partner'=> $partner,
            'structure' => $structure,
            'permissions' => $permissions,
        ]);
    }
    
    /**
     * Change Email + MDP 
     */
    #[Route('/edit/{id<\d+>}/', name: 'app_partner_edit')]
    public function editPartner(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user = null, MailService $mail, PartnerRepository $partnerRepo) : Response
    {
        /**
         * @var User $user 
         */
        $user = $this->getUser();
        if (!$user) {
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

            $this->addFlash('success', 'Votre compte de connexion a bien été modifié');

            $mail->sendEmail(
                'fitnessDrive@outlook.fr',
                $user->getEmail(),
                'Modification de votre compte',
                'editUser',
                compact('user')

            );
            $this->addFlash('send', 'Email de modification a bien été envoyé');
        }
        
        //Recup Partner.name === User.username
        $partner = $partnerRepo->findOneByName($user->getUsername());
        
        return $this->render('partner/user/editUser.html.twig',[
            'formUser' => $form->createView(),
            
            //Variable in editMode
            'editMode' => $user->getId() !== null,
            'h1Edit' => $user->getUsername() !== null,
            'partners' => $partner,
            
        ]);
    }
}