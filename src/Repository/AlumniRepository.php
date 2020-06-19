<?php

namespace App\Repository;

use App\Entity\Alumni;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alumni|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alumni|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alumni[]    findAll()
 * @method Alumni[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alumni::class);
    }

    /**
     * @return Alumni[]
     */
    public function findLast() : array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Alumni[] Returns an array of Alumni objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alumni
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
