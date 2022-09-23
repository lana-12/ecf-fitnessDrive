<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                'row_attr' => ['class' => '', 'id' => 'id_password'],                
                
                'constraints'=> [
                        new NotBlank(['message'=> 'Veuillez saisir un mot de passe!']),
                        new Length([
                            'min'=> 8, 'max'=> 100, 'minMessage' =>'Votre mot de passe doit contenir au moins {{ limit }} caractères',]),
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'data_class'=> User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'email_item',

        ]);
    }
}
