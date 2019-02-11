<?php

namespace App\Repository;

use App\Entity\TbOs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TbOs|null find($id, $lockMode = null, $lockVersion = null)
 * @method TbOs|null findOneBy(array $criteria, array $orderBy = null)
 * @method TbOs[]    findAll()
 * @method TbOs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TbOsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TbOs::class);
    }

    // /**
    //  * @return TbOs[] Returns an array of TbOs objects
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

    public function findLast()
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->getQuery()
        ;
        return $qb->getOneOrNullResult();
    }
}
