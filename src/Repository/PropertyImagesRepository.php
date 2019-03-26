<?php

namespace App\Repository;

use App\Entity\PropertyImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PropertyImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyImages[]    findAll()
 * @method PropertyImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyImagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PropertyImages::class);
    }

    // /**
    //  * @return PropertyImages[] Returns an array of PropertyImages objects
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
    public function findOneBySomeField($value): ?PropertyImages
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
