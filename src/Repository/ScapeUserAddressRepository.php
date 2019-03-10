<?php

namespace App\Repository;

use App\Entity\ScapeUserAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScapeUserAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScapeUserAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScapeUserAddress[]    findAll()
 * @method ScapeUserAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScapeUserAddressRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScapeUserAddress::class);
    }

    // /**
    //  * @return ScapeUserAddress[] Returns an array of ScapeUserAddress objects
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
    public function findOneBySomeField($value): ?ScapeUserAddress
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
