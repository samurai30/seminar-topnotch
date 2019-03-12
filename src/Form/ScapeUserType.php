<?php

namespace App\Form;

use App\Entity\ScapeUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScapeUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userFirstName')
            ->add('userLastName')
            ->add('username')
            ->add('plainPassword')
            ->add('userEmail')
            ->add('userContact')
            ->add('REGISTER', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ScapeUser::class,
        ]);
    }
}
