<?php

namespace App\Form;

use App\Entity\PropertyDetails;
use App\Repository\PropertyDetailsRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\ChoiceFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\NumberRangeFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyDetailFitlerType extends AbstractType
{


    /**
     * @var PropertyDetailsRepository
     */
    private $repository;

    /**
     * PropertyDetailFitlerType constructor.
     * @param PropertyDetailsRepository $repository
     */
    public function __construct(PropertyDetailsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propBHK',ChoiceFilterType::class,[
                'choices' => $this->repository->getDistinctBHK()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyDetails::class,
        ]);
    }
    public function getParent()
    {
        return SharedableFilterType::class;
    }
}
