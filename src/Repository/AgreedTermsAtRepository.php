<?php

namespace App\Repository;

use App\Entity\AgreedTermsAt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgreedTermsAt|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgreedTermsAt|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgreedTermsAt[]    findAll()
 * @method AgreedTermsAt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgreedTermsAtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgreedTermsAt::class);
    }

    // /**
    //  * @return AgreedTermsAt[] Returns an array of AgreedTermsAt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AgreedTermsAt
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
