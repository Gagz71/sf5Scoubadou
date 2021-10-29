<?php

namespace App\Repository;

use App\Entity\UrlPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UrlPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlPicture[]    findAll()
 * @method UrlPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlPicture::class);
    }

    // /**
    //  * @return UrlPicture[] Returns an array of UrlPicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UrlPicture
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
