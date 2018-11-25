<?php

namespace App\Repository;

use App\Entity\WordData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WordData|null find($id, $lockMode = null, $lockVersion = null)
 * @method WordData|null findOneBy(array $criteria, array $orderBy = null)
 * @method WordData[]    findAll()
 * @method WordData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WordDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WordData::class);
    }

//    /**
//     * @return WordData[] Returns an array of WordData objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WordData
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
