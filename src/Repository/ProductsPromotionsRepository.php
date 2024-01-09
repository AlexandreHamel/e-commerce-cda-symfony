<?php

namespace App\Repository;

use App\Entity\ProductsPromotions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductsPromotions>
 *
 * @method ProductsPromotions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductsPromotions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductsPromotions[]    findAll()
 * @method ProductsPromotions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsPromotionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductsPromotions::class);
    }

//    /**
//     * @return ProductsPromotions[] Returns an array of ProductsPromotions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProductsPromotions
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
