<?php

namespace App\Form;

use App\Entity\Partner;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;


use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_partner', TextType::class,[
                'label'=> 'Nom de la franchise',
                'attr'=>[
                'placeholder'=>'exemple Fitness Drive Montpellier...',
                ],
                'required'=> true,
                

                'constraints'=> [
                    new NotBlank(['message'=> 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min'=> 5, 'max'=> 100, 'minMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères']),
                    ]       
                ])  
                
            ->add('phone', TelType::class,[
                'label'=> 'Numéro de téléphone du partenaire',
                'attr'=>[
                'placeholder'=>'exemple 0617236985',
                ],
                'required'=> true, 

                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir un numéro de téléphone valide !']),
                ]
            ])
            

            // ->add('is_active', CheckboxType::class,[
            //     'label'=> 'Activer la franchise',
            //     'required'=> false 
            //     ])
                

            ->add('user', UserType::class,[
                'label'=> 'Information du compte de connection du partenaire', 
                ])
                // ->add('user', CollectionType::class,[
                //     'entry_type'=> User::class,
                //     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //vers quel objet le form va être lié
        $resolver->setDefaults([
            'data_class' => Partner::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'partner_item',
        ]);
    }
}