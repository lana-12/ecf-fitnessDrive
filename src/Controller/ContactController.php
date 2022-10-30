<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    
    #[Route('/contact', name: 'app_contact')]
    public function index(ManagerRegistry $doctrine, EntityManagerInterface $manager, Request $request, MailerInterface $mailer, PartnerRepository $partnerRepo, StructureRepository $structureRepo ): Response
    {

    /**
     * @var User $user 
     */
    $user = $this->getUser();    
    
        $contact = new Contact();
        if ($this->getUser()) {
            $contact->setName($user->getUsername())
                    ->setEmail($user->getEmail());
        }
            $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact= $form->getData();
            
            
            $manager->persist($contact);
            $manager->flush();
            
            // Send Email by contact
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('fitnessDrive@outlook.fr')
                ->subject($contact->getSubject())
                // path of the Twig template to render
                ->htmlTemplate('email/contact.html.twig')
                // pass variables (name => value) to the template
                ->context([
                    'contact' => $contact
                ]);

            $mailer->send($email);
            $this->addFlash('success', 'Votre message a été envoyé avec succès !');
            
        }
        //Recup Partner.name === User.username
        $partner = $partnerRepo->findOneByName($user->getUsername());
        //Recup Structure.name === User.username
        $structure = $structureRepo->findOneByName($user->getUsername());
        
        return $this->render('contact/index.html.twig', [
            'formContact'=> $form->createView(),
            'contact'=>$contact,
            'partners'=>$partner,               
            'structures'=>$structure,               
        ]);
    }
    
}