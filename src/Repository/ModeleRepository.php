<?php

namespace App\Repository;

use App\Entity\Modele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Modele|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modele|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modele[]    findAll()
 * @method Modele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Modele::class);
    }

    public function findWithPandS($value, $secondary) {

    return $this->createQueryBuilder('m')
        ->andWhere('m.id = :id')
        ->setParameter('id', $secondary)
        ->getQuery()
        ->getOneOrNullResult();
    }

    public function findWithNumber($criteria=null, $val=null) {

        $qb = $this->createQueryBuilder('m');

        $qb->andWhere('m.'.$criteria.' like :val')
            ->setParameter('val', $val.'%');

        return $qb->getQuery()
                ->getOneOrNullResult();
    }

    // /**
    //  * @return Modele[] Returns an array of Modele objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Modele
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
