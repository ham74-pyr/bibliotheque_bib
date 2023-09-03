<?php

namespace App\Repository;

use App\Entity\Category5;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category5>
 *
 * @method Category5|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category5|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category5[]    findAll()
 * @method Category5[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Category5Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category5::class);
    }

//    /**
//     * @return Category5[] Returns an array of Category5 objects
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

//    public function findOneBySomeField($value): ?Category5
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
