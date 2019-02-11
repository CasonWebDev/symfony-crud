<?php

namespace App\Repository;

use App\Entity\TbFerramentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TbFerramentas|null find($id, $lockMode = null, $lockVersion = null)
 * @method TbFerramentas|null findOneBy(array $criteria, array $orderBy = null)
 * @method TbFerramentas[]    findAll()
 * @method TbFerramentas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TbFerramentasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TbFerramentas::class);
    }

    // /**
    //  * @return TbFerramentas[] Returns an array of TbFerramentas objects
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
    public function findOneBySomeField($value): ?TbFerramentas
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
