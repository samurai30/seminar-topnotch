<?php

namespace App\Repository;

use App\Entity\ScapeProperties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScapeProperties|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScapeProperties|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScapeProperties[]    findAll()
 * @method ScapeProperties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScapePropertiesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScapeProperties::class);
    }



    // /**
    //  * @return ScapeProperties[] Returns an array of ScapeProperties objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ScapeProperties
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
