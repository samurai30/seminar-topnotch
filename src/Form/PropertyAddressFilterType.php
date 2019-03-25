<?php

namespace App\Form;

use App\Entity\PropertyAddress;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\EntityFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyAddressFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propCity',EntityFilterType::class,[
                'class' => PropertyAddress::class,
                'label' => false,
                'choice_value' => function(PropertyAddress $featured = null){
                    return $featured ? $featured->getPropCity() : '';
                },
                'apply_filter' => function(QueryInterface $query,$field,$values){
                    if (empty($values['value'])){
                        return null;
                    }
                    $expr = $query->getExpr();
                    $paramName = sprintf('p_%s', str_replace('.', '_', $field));
                    $valueSelected = sprintf($values['value']);
                  ;
                    return $query->createCondition( $expr->eq($field, ':'.$paramName),
                        [$paramName => $valueSelected ]);
                },

            ]);
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
