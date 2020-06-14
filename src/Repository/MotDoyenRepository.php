<?php

namespace App\Repository;

use App\Entity\MotDoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MotDoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotDoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotDoyen[]    findAll()
 * @method MotDoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotDoyenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotDoyen::class);
    }

    /**
     * @return MotDoyen[]
     */
    public function findLast() : array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return MotDoyen[] Returns an array of MotDoyen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotDoyen
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
