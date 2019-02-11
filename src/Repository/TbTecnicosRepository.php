<?php

namespace App\Repository;

use App\Entity\TbTecnicos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TbTecnicos|null find($id, $lockMode = null, $lockVersion = null)
 * @method TbTecnicos|null findOneBy(array $criteria, array $orderBy = null)
 * @method TbTecnicos[]    findAll()
 * @method TbTecnicos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TbTecnicosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TbTecnicos::class);
    }

    // /**
    //  * @return TbTecnicos[] Returns an array of TbTecnicos objects
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
    public function findOneBySomeField($value): ?TbTecnicos
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
