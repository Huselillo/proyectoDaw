<?php

namespace App\Repository;

use App\Entity\Temas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Temas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Temas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Temas[]    findAll()
 * @method Temas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Temas::class);
    }
    public function buscarPorPermiso($permiso)
    {
        return $this->createQueryBuilder('t')
            ->select('t.id','t.titulo', 't.titulo1','t.archivo','t.permiso')
            ->andWhere('t.permiso = :permiso')
            ->setParameter('permiso', $permiso)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Temas[] Returns an array of Temas objects
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
    public function findOneBySomeField($value): ?Temas
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
