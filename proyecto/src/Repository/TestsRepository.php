<?php

namespace App\Repository;

use App\Entity\Tests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tests|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tests|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tests[]    findAll()
 * @method Tests[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tests::class);
    }
    public function buscarPorTipoTest($tipo)
    {
        return $this->createQueryBuilder('t')
            ->select('t.id','t.numero', 't.tipo')
            ->andWhere('t.tipo = :tipo')
            ->setParameter('tipo', $tipo)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Tests[] Returns an array of Tests objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tests
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
