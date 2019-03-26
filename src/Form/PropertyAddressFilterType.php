<?php

namespace App\Form;

use App\Entity\PropertyAddress;
use App\Repository\PropertyAddressRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\ChoiceFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\EntityFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyAddressFilterType extends AbstractType
{

    /**
     * @var PropertyAddressRepository
     */
    private $repository;

    /**
     * PropertyAddressFilterType constructor.
     * @param PropertyAddressRepository $repository
     */
    public function __construct(PropertyAddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propCity', ChoiceFilterType::class,[
                'choices' => $this->repository->getDistinctCity(),
            ])
            ->add('propDistrict', ChoiceFilterType::class,[
                'choices' => $this->repository->getDistinctDistrict()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyAddress::class,
        ]);
    }
    public function getParent()
    {
        return SharedableFilterType::class;
    }
}
