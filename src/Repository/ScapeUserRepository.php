<?php

namespace App\Repository;

use App\Entity\ScapeUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScapeUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScapeUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScapeUser[]    findAll()
 * @method ScapeUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScapeUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScapeUser::class);
    }



    // /**
    //  * @return ScapeUser[] Returns an array of ScapeUser objects
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
    public function findOneBySomeField($value): ?ScapeUser
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
