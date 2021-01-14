<?php

namespace App\Repository;

use App\Entity\ReaderPersonalAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReaderPersonalAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReaderPersonalAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReaderPersonalAccount[]    findAll()
 * @method ReaderPersonalAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReaderPersonalAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReaderPersonalAccount::class);
    }

    // /**
    //  * @return ReaderPersonalAccount[] Returns an array of ReaderPersonalAccount objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReaderPersonalAccount
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
