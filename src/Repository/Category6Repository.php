<?php

namespace App\Repository;

use App\Entity\Category6;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category6>
 *
 * @method Category6|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category6|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category6[]    findAll()
 * @method Category6[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Category6Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category6::class);
    }

//    /**
//     * @return Category6[] Returns an array of Category6 objects
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

//    public function findOneBySomeField($value): ?Category6
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
