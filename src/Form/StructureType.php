<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Partner;
use App\Entity\Permission;
use App\Entity\Structure;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //RECUP LA COLLECTION DE PARTNER
            ->add('partner', EntityType::class,[
                'class'=> Partner::class,
                'required'=> true,
                'label'=> 'Selectionner une franchise',
                'placeholder'=>'Choisissez la Franchise',
                'choice_label'=> function (Partner $partner){
                    return $partner->getNamePartner();
                },
                // Classer par ordre alphabétiq
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.namePartner', 'ASC');
                },
    
                
            ])

            //RECUP LA COLLECTION DE USER
            ->add('user', EntityType::class,[
                'label'=> 'Selectionner un compte de connexion',
                'class'=> User::class,
                'required'=> true,
                'placeholder'=>'Choisissez le compte ',
                'choice_label'=> function (User $user){
                    return $user->getUsername();
                },
                // Recup uniquement ROLE_STRUCTURE
                'query_builder' => function (UserRepository $userRepo) {
                    $qb = $userRepo->createQueryBuilder('u');
                    return $qb
                        ->where('u.roles LIKE :role')
                        ->setParameter('role', '%"' . 'ROLE_STRUCTURE' . '"%')
                        ->orderBy('u.username');}

            ])

            ->add('nameStructure', TextType::class,[
                'label'=> 'Nom de la structure',
                'attr'=>[
                'placeholder'=>'Mettre le nom du gérant de la structure ex Dupond',
                ],
                'required'=> true,
                'constraints'=> [
                    new NotBlank(['message'=> 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min'=> 5, 'max'=> 100, 'minMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le nom doit faire entre {{ limit }} et {{ limit }} caractères']),
                    ]       
                ])  
                
            ->add('address', TextType::class,[
                'label'=> 'Adresse de la structure ',
                'attr'=>[
                'placeholder'=>'3 avenur de la mer',
                ],
                'required'=> true, 
                'constraints'=> [
                    new NotBlank(['message'=> 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min'=> 5, 'max'=> 255, 'minMessage' =>'L\'adresse doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'L\'adresse doit faire entre {{ limit }} et {{ limit }} caractères']),
                    ]       
            ])
            ->add('zipcode', TextType::class,[
                'label'=> 'Code Postal',
                'attr'=>[
                'placeholder'=>'exemple 34000',
                ],
                'required'=> true, 
                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir un code postal valide !']),
                    new Length([
                        'min'=> 5, 'max'=> 5, 'minMessage' =>'Le code postal doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le code postal doit faire entre {{ limit }} et {{ limit }} caractères']),
                ]
            ])
            ->add('city', TextType::class,[
                'label'=> 'Ville',
                'attr'=>[
                'placeholder'=>'Montpellier',
                ],
                'required'=> true, 
                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir une ville valide !']),
                    new Length([
                        'min'=> 5, 'max'=> 100, 'minMessage' =>'Le champ doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le champ doit faire entre {{ limit }} et {{ limit }} caractères']),
                ]
            ])
            ->add('phone', TextType::class,[
                'label'=> 'Téléphone de la structure',
                'attr'=>[
                'placeholder'=>'exemple 0617236985',
                ],
                'required'=> true, 
                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir un numéro de téléphone valide !']),
                ]
            ])
            

            ->add('is_active', CheckboxType::class,[
                'label'=> 'Activer la structure',
                'required'=> false 
                ])
                
            
            ->add('short_description', TextType::class,[
                'label'=> 'Courte description ',
                'required'=> false,
                'attr'=>[
                'placeholder'=>'Détail de la structure ...',
                ],    
            ])

            //RECUP LA COLLECTION DE Permissions
            ->add('permissions', EntityType::class, [
                'class' => Permission::class,
                'required' => true,
                'label' => 'Choisissez les options',
                'choice_label'=> 'titre',
                'multiple' => true,
                'placeholder' => 'Choisissez la Franchise',
                'expanded' => true,
                'choice_label' => function (Permission $permission) {
                    return $permission->getTitle();
                    },
                    'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('p')
            ->orderBy('p.title', 'ASC');
                },
                // Classer par ordre alphabétiq
                // 'query_builder' => function (EntityRepository $er) {
                //     return $er->createQueryBuilder('p')
                //         ->orderBy('p.namePartner', 'ASC');
                // },


            ])
            // ->add('short_description', TextType::class,[
            //     'label'=> 'Courte Description',
            //     'required'=> false,
            //     'attr'=>[
            //     'placeholder'=>'...',
            //     ],
            // ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //vers quel objet le form va être lié
        $resolver->setDefaults([
            'data_class' => Structure::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'structure_item',
        ]);
    }
}