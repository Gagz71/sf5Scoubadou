<?php

namespace App\Repository;

use App\Entity\AdoptingRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdoptingRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdoptingRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdoptingRequest[]    findAll()
 * @method AdoptingRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdoptingRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdoptingRequest::class);
    }

    // /**
    //  * @return AdoptingRequest[] Returns an array of AdoptingRequest objects
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
    public function findOneBySomeField($value): ?AdoptingRequest
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
