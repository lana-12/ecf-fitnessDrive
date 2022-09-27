<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Partner;
use App\Entity\User;
use App\Repository\AdminRepository;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]


class AdminUserController extends AbstractController
{
    /**
     * HomePage for Administrator
     * 
     * @return Response
     */
    #[Route('/', name: 'app_admin')]
    public function index(PartnerRepository $partnerRepo, StructureRepository $structureRepo ) : Response
    {

        // A VOIR SI JE NE PEUX PAS LES METTRE DS REPOSITORY
        // display how many partners
        $partners = $partnerRepo->findAllPartner();
        $countPartners = count($partners);

        // display how many structures
        $structures = $structureRepo->findAllStructure();
        $countStructures = count($structures);

        return $this->render('admin/index.html.twig',[
            'titleIndex'=> 'Page des Administrateurs',
            'countPartners'=> $countPartners,
            'countStructures'=> $countStructures,

        ]);
    }


    /**
     * Display List + count
     *
     * @param AdminRepository $adminRepository
     * @return Response
     */
    #[Route('/listpartner', name: 'app_admin_listpartner')]
    public function displayList(ManagerRegistry $doctrine,PartnerRepository $partnerRepo) : Response
    {

        //Methode ds repository queryBuilder mettre ds signature (AdminRepository $adminRepository)
        $repository = $doctrine->getRepository(Partner::class);

        $partners = $repository->findAll();
        dump($partners);
        // Methode display count
        $countPartners= count($partners);
        



        

        return $this->render('admin/list_partner.html.twig',[
            'titleList'=> 'Liste des Franchises',
            'countPartners'=> $countPartners,
            'partners'=> $partners,
            
        ]);
    }

    
    #[Route('/show', name: 'app_admin_show_structure')]
    public function showStructure() : Response
    {
        

        return $this->render('admin/show_structure.html.twig',[
            
        ]);

    }


    /**
     * Display one 
     */
    #[Route('/findadmin', name: 'app_admin_findadmin')]
    public function findByName(AdminRepository $adminRepository) : Response
    {
        //Methode ds repository queryBuilder mettre ds signature (AdminRepository $adminRepository)
        $admin = $adminRepository->findOneByName('Admin02');
        dump($admin);

        return $this->render('admin/admin.html.twig',[
            'titleList'=> 'Admin',
            'admin'=> $admin,
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


