<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'row_attr' => ['class' => '', 'id' => 'name'],
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min' => 5, 'max' => 100, 'minMessage' => 'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' => 'Le nom doit faire entre {{ limit }} et {{ limit }} caractères'
                    ]),
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'row_attr' => ['class' => '', 'id' => 'email'],
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un Email valide !']),
                    new Email(['mode' => 'html5', 'message' => 'L\'adresse {{ value }} n\'est pas valide']),
                ]
            ])

            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'required' => true,
                'row_attr' => ['class' => '', 'id' => 'subjectEmail'],
                'attr' => [
                    'placeholder' => 'Sujet de la demande'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un mot de passe!']),
                    new Length([
                        'min' => 5, 'max' => 100, 'minMessage' => 'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' => 'Le nom doit faire entre {{ limit }} et {{ limit }} caractères'
                    ]),
                ]
            ])

            ->add('message', TextareaType::class, [
                'label' => 'Votre Message',
                'attr' => [
                    'placeholder' => 'Votre message...'
                ],
                'required' => true,
                'row_attr' => ['class' => '', 'id' => 'messageEmail'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir le même mot de passe!']),
                    new Length([
                        'min' => 5, 'max' => 100, 'minMessage' => 'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' => 'Le nom doit faire entre {{ limit }} et {{ limit }} caractères'
                    ]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //vers quel objet le form va être lié
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contact_item',
        ]);
    }
}