<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('username', TextType::class,[
                'label'=> 'Nom',
                'required'=> true,
                'row_attr' => ['class' => '', 'id' => 'username'],
                'attr'=>[
                    'placeholder'=>'',
                    ],
                'constraints'=> [
                    new NotBlank(['message'=> 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min'=> 5, 'max'=> 100, 'minMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères']),
                    ]       
                ])  
                
            ->add('email', EmailType::class,[
                'label'=> 'Email',
                'required'=> true, 
                'row_attr' => ['class' => '', 'id' => 'email'],
                'attr'=>[
                    'placeholder'=>'',
                    ],
                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir un Email valide !']),
                    new Email(['mode'=>'html5', 'message'=>'L\'adresse {{ value }} n\'est pas valide']),
                ]
                ])

            ->add('password', PasswordType::class,[
                'label'=> 'Mot de passe',
                'required'=> true, 
                'row_attr' => ['class' => '', 'id' => 'id_password'],                
                'constraints'=> [
                        new NotBlank(['message'=> 'Veuillez saisir un mot de passe!']),
                        new Length([
                            'min'=> 8, 'max'=> 100, 'minMessage' =>'Votre mot de passe doit contenir au moins {{ limit }} caractères',]),
                    ]
                ])
                
            ->add('confirmPassword', PasswordType::class,[
                'label'=> 'Confirmation du mot de passe',
                'required'=> true, 
                
                'row_attr' => ['class' => '', 'id' => 'mdpUser'],                
                'constraints'=> [
                        new NotBlank(['message'=> 'Veuillez saisir le même mot de passe!']),
                        new Length([
                            'min'=> 8, 'max'=> 100, 'minMessage' =>'Votre mot de passe doit contenir au moins {{ limit }} caractères',]),
                        // new EqualTo(['propertyPath'=>'password', 'message'=>'Vous n\'avez pas tapé le même mot de passe'])
                    ]
                ])


            ->add('roles', ChoiceType::class,[
                'required'=> true,
                'label'=> 'Type d\'utilisateur',
                'placeholder'=>'Choisissez ...',
                'choices' => [
                    'Franchise' => 'ROLE_PARTNER',
                    'Structure'=> 'ROLE_STRUCTURE'
                ],
        ]);

        // Permet la manipulation an array
            $builder->get('roles')
                    ->addModelTransformer(new CallbackTransformer(
                        function ($rolesAsArray) {
                    // transform the array to a string
                        return implode(', ', $rolesAsArray);
                },
                        function ($rolesAsString) {
                    // transform the string back to an array
                        return explode(', ', $rolesAsString);
                }
            ));
                    

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //vers quel objet le form va être lié
        $resolver->setDefaults([
            'data_class' => User::class,
            // 'csrf_protection' => true,
            // 'csrf_field_name' => '_token',
            // 'csrf_token_id' => 'user_item',
        ]);
    }
}