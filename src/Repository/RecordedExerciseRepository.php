<?php

namespace App\Repository;

use App\Entity\RecordedExercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecordedExercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecordedExercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecordedExercise[]    findAll()
 * @method RecordedExercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordedExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecordedExercise::class);
    }

    // /**
    //  * @return RecordedExercise[] Returns an array of RecordedExercise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecordedExercise
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
