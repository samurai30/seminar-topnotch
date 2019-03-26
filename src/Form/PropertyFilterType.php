<?php

namespace App\Form;

use App\Entity\ScapeProperties;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                    $qbe->addOnce($qbe->getAlias().'.featured','opt2',$closure);
                },
            ])
            ->add('propertyAddress', PropertyAddressFilterType::class,[
                'add_shared' => function (FilterBuilderExecuterInterface $qbe){
                    $closure = function (QueryBuilder $filterBuilder,$alias,$joinAlias,Expr $expr){
                        $filterBuilder->leftJoin($alias.'.propertyAddress',$joinAlias);
                    };
                    $qbe->addOnce($qbe->getAlias().'.propertyAddress','opt3',$closure);
                },
                'label' => false
            ])
            ->add('propDetails', PropertyDetailFitlerType::class,[
                'add_shared' => function (FilterBuilderExecuterInterface $qbe){
                    $closure = function (QueryBuilder $filterBuilder,$alias,$joinAlias,Expr $expr){
                        $filterBuilder->leftJoin($alias.'.propDetails',$joinAlias);
                    };
                    $qbe->addOnce($qbe->getAlias().'.propDetails','opt4',$closure);
                },
                'label' => false
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
