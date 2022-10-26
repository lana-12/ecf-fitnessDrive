<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{

    /**
     * @var UserEntity
     */

    #[Route('/contact', name: 'app_contact')]
    public function index(EntityManagerInterface $manager, Request $request, MailerInterface $mailer): Response
    {
        
        $contact = new Contact();


        // if ($this->getUser()) {
        //     $contact->setName($this->getUser()->getUsername())
        //             ->setEmail($this->getUser()->getEmail());
        // }


            $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact= $form->getData();
            // dd($form->getData());

            $manager->persist($contact);
            $manager->flush();

            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('fitnessDrive@outlook.fr')
                ->subject($contact->getSubject())

                // path of the Twig template to render
                ->htmlTemplate('emails/contact.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'contact' => $contact
                    
                ]);

            $mailer->send($email);



            $this->addFlash('success', 'Votre message a été envoyé avec succès !');
            
        }
        
        
        return $this->render('contact/index.html.twig', [
            'formContact'=> $form->createView(),
            
        ]);
    }
    
}