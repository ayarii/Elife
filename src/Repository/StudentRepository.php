<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function listOfStudentOrderByName()
    {
        $query = $this->createQueryBuilder('s')
            ->andWhere('s.firstName = :val')
            ->andWhere('s.lastName= :val2')
            ->setParameter('val', "Mohamed")
            ->setParameter('val2', "Ayari")
            ->orderBy('s.nce', 'DESC')
            ->setMaxResults(10)
            ->getQuery();
        return $query->getResult();
    }

    public function listStudent()
    {
        $query = $this->createQueryBuilder('s')
            ->where('s.firstName LIKE :val')
            ->setParameter('val', 'M%')
            #  ->setParameter('val','%M')
            #  ->setParameter('val','%M%')
            ->getQuery();
        return $query->getResult();
    }

   public function searchStudent($nce){
        $query= $this->createQueryBuilder('s')
            ->where('s.nce LIKE :val')
        ->setParameter('val',$nce)
            ->getQuery();
        return $query->getResult();
   }
}
