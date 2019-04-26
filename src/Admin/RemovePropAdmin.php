<?php
/**
 * Created by PhpStorm.
 * User: Samurai
 * Date: 26-04-2019
 * Time: 08:01 PM
 */

namespace App\Admin;


use App\Entity\ScapeUser;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class RemovePropAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_vendor_removeprop_scapeproperty';

    protected $baseRoutePattern = 'scapeproperty-remove';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

    protected function configureListFields(ListMapper $list)
    {
       $list->add('propName')
           ->add('scapeUser',null,[
               'class' => ScapeUser::class
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