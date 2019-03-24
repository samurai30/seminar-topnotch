<?php

namespace App\Form;

use App\Entity\PropertyCategory;
use App\Repository\PropertyCategoryRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\ChoiceFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\EntityFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryName',EntityFilterType::class,[
                'class' => PropertyCategory::class,
                'label' => false,
                'choice_attr' =>['placeholder' => 'Select Cat' ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyCategory::class,
        ]);
    }
    public function getParent()
    {
        return SharedableFilterType::class;
    }
}
