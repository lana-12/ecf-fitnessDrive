<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de la Permission',
                'attr' => [
                    'placeholder' => 'ex: Gérer les planning',
                ],
                'required' => true,

                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un titre de permission !']),
                    new Length([
                        'min' => 2, 'max' => 250,
                    'minMessage' => 'Le nom de la permission doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' => 'Le nom de la pr doit faire entre {{ limit }} et {{ limit }} caractères'
                    ]),
                ]
            ])
            
            ->add('description', TextareaType::class, [
                'label' => 'Description de la Permission',
                'attr' => [
                    'placeholder' => 'Logiciel pour gérer les planning,...',
                ],
                'required' => true,

                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une description de permission !']),
                    new Length([
                        'min' => 2, 'max' => 5000,
                    'minMessage' => 'La description de la permission doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' => 'La description de la pr doit faire entre {{ limit }} et {{ limit }} caractères'
                    ]),
                ]
            ])

            ->add('is_active', CheckboxType::class, [
                'label' => 'Activer la permission',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //vers quel objet le form va être lié
        $resolver->setDefaults([
            'data_class' => Permission::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'permission_item',
        ]);
    }
}