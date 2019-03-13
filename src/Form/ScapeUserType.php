<?php

namespace App\Form;

use App\Entity\ScapeUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScapeUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userFirstName', TextType::class, [
                'attr' => ['placeholder' => 'Enter First Name'],
                'label' => false
            ])
            ->add('userLastName', TextType::class,[
                'attr' => ['placeholder' => 'Enter Last Name'],
                'label' => false
            ])
            ->add('username', TextType::class,[
                'attr' => ['placeholder' => 'Enter Username'],
                'label' => false
            ])
            ->add('plainPassword',RepeatedType::class,[
                'type' => PasswordType::class,
                'first_options' => ['attr' =>  ['placeholder' => 'password'],
                    'label' => false],
                'second_options' => ['attr' => ['placeholder' => 'confirm password']
                    , 'label' => false],
                'label' => 'Password'
            ])
            ->add('userEmail', EmailType::class,[
                'attr' => ['placeholder' => 'Enter Email-Address'],
                'label' => false
            ])
            ->add('userContact', TextType::class,[
                'attr' => ['placeholder' => 'Enter Contact Number'],
                'label' => false
            ])
            ->add('address', ScapeUserAddressType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ScapeUser::class,
        ]);
    }
}
