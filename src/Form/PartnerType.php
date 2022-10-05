<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Partner;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

                //RECUP LA COLLECTION DE USER
            ->add('user', EntityType::class,[
                'class'=> User::class,
                'label'=> 'Selectionner un compte',
                'placeholder'=>'Choisissez le compte de connexion',
                'choice_label'=> function (User $user){
                    return $user->getUsername();
                },
                'query_builder' => function (UserRepository $userRepo) {
                    $qb = $userRepo->createQueryBuilder('u');
                    return $qb
                        ->where('u.roles LIKE :role')
                        ->setParameter('role', '%"' . 'ROLE_PARTNER' . '"%')
                        ->orderBy('u.username');}

            ])

            ->add('namePartner', TextType::class,[
                'label'=> 'Nom de la franchise',
                'attr'=>[
                'placeholder'=>'Mettre le nom de la ville',
                ],
                'required'=> true,
                
                'constraints'=> [
                    new NotBlank(['message'=> 'Le champ ne peut pas être vide !']),
                    new Length([
                        'min'=> 5, 'max'=> 100, 'minMessage' =>'Le champ doit faire entre {{ limit }} et {{ limit }} caractères', 'maxMessage' =>'Le champ doit faire entre {{ limit }} et {{ limit }} caractères']),
                    ]       
                ])  
                
            ->add('phone', TelType::class,[
                'label'=> 'Téléphone du partenaire',
                'attr'=>[
                'placeholder'=>'exemple 0617236985',
                ],
                'required'=> true, 

                'constraints'=> [
                    new NotBlank(['message'=> 'Veuillez saisir un numéro de téléphone valide !']),
                    new Length([
                        'min'=> 10, 'max'=> 10, 'exactMessage' =>'Le numéro de téléphone doit faire {{ limit }} caractères']),
                ]
            ])
            
            ->add('is_active', CheckboxType::class,[
                'label'=> 'Activer la franchise',
                'required'=> false 
                ])
                
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
