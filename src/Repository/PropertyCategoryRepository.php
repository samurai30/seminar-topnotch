<?php

namespace App\Repository;

use App\Entity\PropertyCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PropertyCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyCategory[]    findAll()
 * @method PropertyCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PropertyCategory::class);
    }

    // /**
    //  * @return PropertyCategory[] Returns an array of PropertyCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropertyCategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
