<?php

namespace App\Repository;

use App\Entity\TbServicos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TbServicos|null find($id, $lockMode = null, $lockVersion = null)
 * @method TbServicos|null findOneBy(array $criteria, array $orderBy = null)
 * @method TbServicos[]    findAll()
 * @method TbServicos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TbServicosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TbServicos::class);
    }

    // /**
    //  * @return TbServicos[] Returns an array of TbServicos objects
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
    public function findOneBySomeField($value): ?TbServicos
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
