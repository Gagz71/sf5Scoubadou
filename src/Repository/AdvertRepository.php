<?php

namespace App\Repository;

use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    public function callThreeLastAdverts()
    {
        return $this->createQueryBuilder('advert')
            ->orderBy('advert.creationDate', 'DESC')
            ->setMaxResults(3)
            ->where('advert.status = true')
            ->getQuery()
            ->getResult();
    }

    public function callTwoNextAdverts()
    {
        return $this->createQueryBuilder('advert')
            ->orderBy('advert.creationDate', 'DESC')
            ->setFirstResult(3)
            ->setMaxResults(2)
            ->where('advert.status = true')
            ->getQuery()
            ->getResult();
    }
}
