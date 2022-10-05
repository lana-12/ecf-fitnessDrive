<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Partner;
use App\Entity\Structure;
use App\Entity\User;
use App\Repository\AdminRepository;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/admin')]


class AdminController extends AbstractController
{
    /**
     * HomePage for Administrator
     * 
     * @return list partner + count partner+structure
     */
    #[Route('/', name: 'app_admin')]
    
    public function index(PartnerRepository $partnerRepo, StructureRepository $structureRepo, ManagerRegistry $doctrine ) : Response
    {
        //Methode avec PartnerRepository => recup tt les partners
        $partners = $partnerRepo->findAllPartner();
        //Methode avec StructureRepository => recup tt les structures
        $structures = $structureRepo->findAllStructure();

        //Methode avec ManagerRegistry => recup tt les partners
        // $repository = $doctrine->getRepository(Partner::class);
        // $partners = $repository->findAll();

        // display how many partners
        $countPartners = count($partners);
        // display how many structures
        $countStructures = count($structures);

        return $this->render('admin/index.html.twig',[
            'titleIndex'=> 'Listes des Franchises',
            'countPartners'=> $countPartners,
            'countStructures'=> $countStructures,
            'partners'=> $partners,

        ]);
    }

    #[Route('/showpartner/{id<\d+>}', name: 'show-partner')]
    public function showPartner(ManagerRegistry $doctrine, int $id, StructureRepository $structureRepo) : Response
    {
        $repository = $doctrine->getRepository(Partner::class);
        $partner = $repository->find($id);

            $structures = $structureRepo->findAllStructure();
            dump($structures);
            $error = 'Aucune structure associée';
            return $this->render('admin/showpartner.html.twig',[
                'partner'=> $partner,
                'structures'=> $structures,
                'error' => $error,
            ]);
            
        // } else{
        //     $error = 'Aucune structure associée';
        //     return $this->render('admin/showpartner.html.twig',[
        //         'partner'=> $partner,
        //         'error' => $error,
        //     ]);
        // }
        

    }
    #[Route('/showstructure/{id<\d+>}', name: 'show-structure')]
    public function showStructure(ManagerRegistry $doctrine, int $id ) : Response
    {
        $repository = $doctrine->getRepository(Structure::class);
        $structure = $repository->find($id);

        return $this->render('admin/showstructure.html.twig',[
            'structure'=> $structure,
        ]);

    }

    /**
     * Update Partner
     */
    #[Route('/updatePartner/{id<\d+>}', name: 'updatePartner')]
    public function findByName(PartnerRepository $partnerRepo, int $id) : Response
    {
        //Methode ds repository queryBuilder mettre ds signature (AdminRepository $adminRepository)
        $partner = $partnerRepo->findBy($id) ;
        dump($partner);

        return $this->render('admin/formPartner.html.twig',[
            'titleList'=> 'Admin',
            'admin'=> $partner,
        ]);

    }





    /**
     * Display ListAdmins + countadmins
     *
     * @param AdminRepository $adminRepository
     * @return Response
     */
    #[Route('/listadmin', name: 'app_admin_listadmin')]
    public function displayListAdmnins(AdminRepository $adminRepository) : Response
    {

        //Methode ds repository queryBuilder mettre ds signature (AdminRepository $adminRepository)
        $admins = $adminRepository->findAllAdmin();
        dump($admins);


        // Methode display countAdmin
        $countAdmin = count($admins);

        return $this->render('admin/list_admin.html.twig',[
            'titleList'=> 'Liste des Administrateurs',
            'countAdmins'=> $countAdmin,
            'admins'=> $admins,
        ]);
    }

    /**
     * Display one admin 
     */

    #[Route('/findadmin', name: 'app_admin_findadmin')]
    public function findAdmninByName(AdminRepository $adminRepository) : Response
    {
        //Methode ds repository queryBuilder mettre ds signature (AdminRepository $adminRepository)
        $admin = $adminRepository->findOneByName('Admin02');
        dump($admin);

        return $this->render('admin/admin.html.twig',[
            'titleList'=> 'Admin',
            'admin'=> $admin,
        ]);

    }



    
}


