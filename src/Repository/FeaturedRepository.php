<?php

namespace App\Repository;

use App\Entity\Featured;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Featured|null find($id, $lockMode = null, $lockVersion = null)
 * @method Featured|null findOneBy(array $criteria, array $orderBy = null)
 * @method Featured[]    findAll()
 * @method Featured[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeaturedRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Featured::class);
    }
    public function getFeatured($value){
        return $this->createQueryBuilder('c')
            ->select('c, cc')
            ->leftJoin('c.scapeProperty', 'cc')
            ->where('c.type = :val')
            ->andWhere( 'cc.propStatus = :val2')
            ->setParameter('val',$value)
            ->setParameter('val2','available')
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Featured[] Returns an array of Featured objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Featured
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
