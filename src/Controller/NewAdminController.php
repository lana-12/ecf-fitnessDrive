<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/new')]

class NewAdminController extends AbstractController
{
    /**
     * to create an Admin by the controller only
     */
    #[Route('/', name: 'app_admin_new')]

    public function addAdmin(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, User $user=null): Response
    {
        if(!$user){
            $user = new User();
        }
        // Administrateur 01
        $user->setUsername('Admin01');
        $user->setEmail('fitnessdrive.ad01@outlook.com');
        $plaintextPassword='Ad01_FitnessDrive';
        $user->getPassword();
        $hashedPassword = $userPasswordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $admin01= $user;
        $entityManager->persist($admin01);
        $entityManager->flush();

        // Administrateur 02
        $user->setUsername('Admin02');
        $user->setEmail('fitnessdrive.ad02@outlook.com');
        $plaintextPassword= 'Ad02_FitnessDrive';
        $user->getPassword();
        $hashedPassword = $userPasswordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $admin02= $user;
        $entityManager->persist($admin02);
        $entityManager->flush();

        return $this->render('user/index.html.twig',[
                'user01'=> $admin01,
                'user02'=> $admin02,
        ]);
        }

    }
