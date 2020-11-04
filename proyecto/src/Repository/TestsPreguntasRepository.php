<?php

namespace App\Repository;

use App\Entity\TestsPreguntas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TestsPreguntas|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestsPreguntas|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestsPreguntas[]    findAll()
 * @method TestsPreguntas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestsPreguntasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestsPreguntas::class);
    }

    public function buscarPorId($idTest)
    {
        return $this->createQueryBuilder('tp')
            ->leftJoin('tp.id_pregunta', 'p')
            ->select('p.id','p.pregunta','p.r1','p.r2','p.r3','p.correcta','p.foto')
            ->leftJoin('tp.id_test', 't')
            ->andWhere('t.id = :test')
            ->setParameter('test' , $idTest)
            ->getQuery()
            ->getResult()
        ;
    }
    

    // /**
    //  * @return TestsPreguntas[] Returns an array of TestsPreguntas objects
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
    public function findOneBySomeField($value): ?TestsPreguntas
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
