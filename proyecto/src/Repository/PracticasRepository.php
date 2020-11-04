<?php

namespace App\Repository;

use App\Entity\Practicas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Practicas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Practicas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Practicas[]    findAll()
 * @method Practicas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PracticasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Practicas::class);
    }
    public function buscarPorId($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idUsuario = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    public function buscarPorIdProfesor($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id_profesor = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Practicas[] Returns an array of Practicas objects
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
    public function findOneBySomeField($value): ?Practicas
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
