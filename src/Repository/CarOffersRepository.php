<?php

namespace App\Repository;

use App\Entity\CarOffers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarOffers>
 *
 * @method CarOffers|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarOffers|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarOffers[]    findAll()
 * @method CarOffers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarOffersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarOffers::class);
    }

//    /**
//     * @return CarOffers[] Returns an array of CarOffers objects
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

//    public function findOneBySomeField($value): ?CarOffers
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
