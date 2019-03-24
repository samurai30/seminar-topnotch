<?php

namespace App\Form;

use App\Entity\ScapeUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScapeUserFPType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword',RepeatedType::class,[
                'type' => PasswordType::class,
                'first_options' => ['attr' =>  ['placeholder' => 'password'],
                    'label' => false],
                'second_options' => ['attr' => ['placeholder' => 'confirm password']
                    , 'label' => false],
                'label' => 'Password'
            ])
            ->add('ChangePassword', SubmitType::class,[
                'label'=>'Change Password',
                'attr' => ['class' => 'btn']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ScapeUser::class,
        ]);
    }
}
