<?php

namespace App\Repository;

use App\Entity\CarOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarOffer>
 *
 * @method CarOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarOffer[]    findAll()
 * @method CarOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarOffer::class);
    }

//    /**
//     * @return CarOffer[] Returns an array of CarOffer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarOffer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}