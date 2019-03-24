<?php

namespace App\Form;

use App\Entity\PropertyCategory;
use App\Entity\ScapeProperties;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use http\QueryString;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\ChoiceFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\EntityFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propName', TextFilterType::class,[
                'label' => 'Property Name'
            ])
           ->add('category', PropertyCategoryType::class,[
               'add_shared' => function(FilterBuilderExecuterInterface $qbe){
               $closure = function (QueryBuilder $queryBuilder,$alias,$joinAlias,Expr $expr){
                   $queryBuilder->leftJoin($alias.'.category',$joinAlias);
               };
               $qbe->addOnce($qbe->getAlias().'.category','opt',$closure);
               }
           ])
            ->add('featured', FeaturedType::class,[
                'add_shared' => function (FilterBuilderExecuterInterface $qbe){
                    $closure = function (QueryBuilder $filterBuilder,$alias,$joinAlias,Expr $expr){
                        $filterBuilder->leftJoin($alias.'.featured',$joinAlias);
                    };
                    $qbe->addOnce($qbe->getAlias().'.featured','opt',$closure);
                },
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
