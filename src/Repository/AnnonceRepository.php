<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    /**
     * @return Annonce[]
     */
    public function findByDate($categorie) : array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->orderBy('a.date', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Annonce[]
     */
    public function findByStatus() : array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.statut = 1')
            ->orderBy('a.date', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Annonce[]
     */
    public function findLast($categorie) : array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->orderBy('a.date', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Annonce[]
     */
    public function findByEvent() : array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.event = 1')
            ->orderBy('a.date', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }







    // /**
    //  * @return Annonce[] Returns an array of Annonce objects
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
    public function findOneBySomeField($value): ?Annonce
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
