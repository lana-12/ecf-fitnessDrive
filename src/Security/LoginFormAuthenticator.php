<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Routing\RouterInterface;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(Security::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        
        // $roles = $token->getRoleNames();
        // dump($roles);


        // if (in_array('ROLE_STRUCTURE', $roles, true)) {
        //     $user = $token->getUser();
        //     return new RedirectResponse($this->urlGenerator->generate("app_structure_show"));
        // } else if (in_array('ROLE_PARTNER', $roles, true)) {
        //     $user = $token->getUser();
        //     return new RedirectResponse($this->urlGenerator->generate("app_partner_show"));
        // }

        return new RedirectResponse($this->urlGenerator->generate('app_home'));


        
        // if ($user->getRoles() == 'ROLE_PARTNER') {
        //     // $user = $token->getUser();
        //     $id = $user->getId();
        //     return new RedirectResponse($this->urlGenerator->generate('app_partner_show',['id' => $id] ));
            
        // } else if ($user->getRoles() == 'ROLE_STRUCTURE'){
        //     // $user = $token->getUser();
        //     $id = $user->getId();
        //     return new RedirectResponse($this->urlGenerator->generate('app_structure_show', ['id' => $id] ));
        // } 
        // else {
        //     return new RedirectResponse($this->urlGenerator->generate('app_admin'));
            
        // }
        // return new RedirectResponse($this->router->generate('/'));
        // For example:
        // return $this->render('client/client.html.twig');
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}