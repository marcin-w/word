<?php

namespace App\Repository;

use App\Entity\UserHasWord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserHasWord|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasWord|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasWord[]    findAll()
 * @method UserHasWord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasWordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserHasWord::class);
    }

//    /**
//     * @return UserHasWord[] Returns an array of UserHasWord objects
//     */
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
    public function findOneBySomeField($value): ?UserHasWord
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
