<?php

namespace App\Repository;

use App\Entity\Preguntas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Preguntas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Preguntas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Preguntas[]    findAll()
 * @method Preguntas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreguntasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Preguntas::class);
    }
    public function buscarCorrecta($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id' , $id)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function buscarUnaCorrecta($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id' , $id)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Preguntas[] Returns an array of Preguntas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Preguntas
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
