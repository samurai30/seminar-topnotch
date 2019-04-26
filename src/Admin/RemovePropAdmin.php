<?php
/**
 * Created by PhpStorm.
 * User: Samurai
 * Date: 26-04-2019
 * Time: 08:01 PM
 */

namespace App\Admin;


use App\Entity\Featured;
use App\Entity\ScapeUser;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RemovePropAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_vendor_removeprop_scapeproperty';

    protected $baseRoutePattern = 'scapeproperty-remove';

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
       $filter->add('scapeUser')
       ->add('propName');
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

    protected function configureListFields(ListMapper $list)
    {
       $list->add('propName',null,['label' => 'Property Name'])
           ->add('scapeUser',null,[
               'class' => ScapeUser::class,
               'label' => 'Vendor Username'
           ]);

    }
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.propStatus', ':my_param')
        );
        $query->setParameter('my_param', 'available');
        return $query;
    }



}