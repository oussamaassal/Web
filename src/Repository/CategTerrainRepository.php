<?php

namespace App\Repository;

use App\Entity\CategTerrain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategTerrain>
 *
 * @method CategTerrain|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategTerrain|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategTerrain[]    findAll()
 * @method CategTerrain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategTerrainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategTerrain::class);
    }

//    /**
//     * @return CategTerrain[] Returns an array of CategTerrain objects
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

//    public function findOneBySomeField($value): ?CategTerrain
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
