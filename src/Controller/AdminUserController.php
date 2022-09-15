<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\User;
use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class AdminUserController extends AbstractController
{
    /**
     * HomePage for Administrator
     * 
     * @return Response
     */
    #[Route('/admin', name: 'app_admin')]
    public function index() : Response
    {
        
        return $this->render('admin/index.html.twig',[
            'titleIndex'=> 'Page des Administrateurs',
        ]);
    }


    /**
     * Display ListAdmins + countadmins
     *
     * @param AdminRepository $adminRepository
     * @return Response
     */
    #[Route('/admin/listadmin', name: 'app_admin_listadmin')]
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

    #[Route('/admin/findadmin', name: 'app_findadmin')]
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


