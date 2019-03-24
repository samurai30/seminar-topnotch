<?php

namespace App\Repository;

use App\Entity\SacpeUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SacpeUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SacpeUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method SacpeUser[]    findAll()
 * @method SacpeUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SacpeUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SacpeUser::class);
    }

    // /**
    //  * @return SacpeUser[] Returns an array of SacpeUser objects
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
    public function findOneBySomeField($value): ?SacpeUser
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
