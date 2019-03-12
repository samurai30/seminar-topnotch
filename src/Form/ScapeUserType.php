<?php

namespace App\Form;

use App\Entity\ScapeUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScapeUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userFirstName')
            ->add('userLastName')
            ->add('userEmail')
            ->add('userContact')
            ->add('username')
            ->add('password')
            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ScapeUser::class,
        ]);
    }
}
