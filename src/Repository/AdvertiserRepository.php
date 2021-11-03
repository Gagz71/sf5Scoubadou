<?php

namespace App\Repository;

use App\Entity\Advertiser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advertiser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertiser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertiser[]    findAll()
 * @method Advertiser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertiserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advertiser::class);
    }

    public function getAdvertsByDate() {
        return $this->createQueryBuilder('adv')
            ->leftjoin('adv.adverts', 't')
            ->orderBy('t.creationDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Advertiser[] Returns an array of Advertiser objects
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
    public function findOneBySomeField($value): ?Advertiser
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
