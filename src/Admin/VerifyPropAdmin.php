<?php
/**
 * Created by PhpStorm.
 * User: Samurai
 * Date: 26-04-2019
 * Time: 07:29 PM
 */

namespace App\Admin;


use App\Entity\ScapeProperties;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VerifyPropAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_vendor_verifyprop_scapeproperty';

    protected $baseRoutePattern = 'scapeproperty-verify';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('propName',TextType::class,[
            ''
        ])
        ->add('propertyAddress')
            ->add('propStatus', 'choice', [
                'editable' => true,
                'class' => ScapeProperties::class,
                'choices' => [
                    'available' => 'available'
                ],
            ]);
    }
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.propStatus', ':my_param')
        );
        $query->setParameter('my_param', 'unavailable');
        return $query;
    }

}