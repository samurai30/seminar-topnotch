<?php

namespace App\Form;

use App\Entity\PropertyCategory;
use App\Entity\ScapeProperties;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorPropertyAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propName',TextType::class)
            ->add('propNotes', TextareaType::class)
            ->add('propertyAddress', VendorPropAddressType::class)
            ->add('category', EntityType::class,[
                'class' => PropertyCategory::class
            ])
            ->add('propDetails',VendorPropDetailsType::class)
            ->add('submit', SubmitType::class,[
                'attr'=> ['class'=> 'btn']
            ])
            ->add('Images', FileType::class,[
                'mapped' => false,
                'label' => 'Please Upload Images',
                'multiple' => true,
                'attr' =>[
                    'accept' => 'image/*'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ScapeProperties::class,
        ]);
    }
}
