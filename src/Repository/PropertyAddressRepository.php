<?php

namespace App\Repository;

use App\Entity\PropertyAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PropertyAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyAddress[]    findAll()
 * @method PropertyAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyAddressRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PropertyAddress::class);
    }

    public function getDistinctCity(){

        $results = $this->createQueryBuilder('city')
            ->select('DISTINCT city.propCity')
            ->getQuery()
            ->getResult();

        $cityArray = [];
         foreach ($results as $result){
            $cityArray += [$result['propCity'] => $result['propCity']];

        }
        return $cityArray;
    }

    public function getDistinctDistrict(){
        $results = $this->createQueryBuilder('district')
            ->select('DISTINCT district.propDistrict')
            ->getQuery()
            ->getResult();

        $propDistrictArray = [];
        foreach ($results as $result){
            $propDistrictArray += [$result['propDistrict'] => $result['propDistrict']];

        }
        return $propDistrictArray;
    }
    // /**
    //  * @return PropertyAddress[] Returns an array of PropertyAddress objects
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
    public function findOneBySomeField($value): ?PropertyAddress
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
