<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                'required'=> true,
                'row_attr' => ['class' => '', 'id' => 'username'],

                'constraints'=> [
                    new NotBlank(['message'=> 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min'=> 5, 'max'=> 100, 'minMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères']),
                    ]       
                ])  
                
            ->add('email', EmailType::class,[
                'required'=> true, 
                'row_attr' => ['class' => '', 'id' => 'email'],

                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir un Email valide !']),
                    new Email(['mode'=>'html5', 'message'=>'L\'adresse {{ value }} n\'est pas valide']),
                ]
            ])

            ->add('password', PasswordType::class,[
                'required'=> true, 
                'row_attr' => ['class' => '', 'id' => 'mdpUser'],                
                
                'constraints'=> [
                        new NotBlank(['message'=> 'Veuillez saisir un mot de passe!']),
                        new Length([
                            'min'=> 8, 'max'=> 100, 'minMessage' =>'Votre mot de passe doit contenir au moins {{ limit }} caractères',]),
                    ]
                ])
                
            // ->add('confirmPassword', PasswordType::class,[
            //     'required'=> true, 
            //     'row_attr' => ['class' => '', 'id' => 'mdpUser'],                

            //     'constraints'=> [
            //             new NotBlank(['message'=> 'Veuillez saisir le même mot de passe!']),
            //             new Length([
            //                 'min'=> 8, 'max'=> 100, 'minMessage' =>'Votre mot de passe doit contenir au moins {{ limit }} caractères',]),
            //             // new EqualTo(['propertyPath'=>'password', 'message'=>'Vous n\'avez pas tapé le même mot de passe'])
            //         ]

            // ])


            // ->add('role', TextType::class,[
            //     'label'=> 'Nom','required'=> true])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //vers quel objet le form va être lié
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
