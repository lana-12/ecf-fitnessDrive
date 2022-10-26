<?php

namespace App\Controller;

use App\Form\LoginUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('app_admin');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // $error = 'Votre identifiant ou votre Mot de passe est incorrect !';
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // $form = $this->createForm(LoginUserType::class);
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()){

        // }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}