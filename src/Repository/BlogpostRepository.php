<?php

namespace App\Repository;

use App\Entity\Blogpost;
use App\Entity\Peinture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Blogpost>
 *
 * @method Blogpost|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blogpost|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blogpost[]    findAll()
 * @method Blogpost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogpostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blogpost::class);
    }

    public function save(Blogpost $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Blogpost $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Pour récupérer les trois dernières penturesi
    /**
     * @return Peinture[] Returns an array of Peinture objects
     */
    public function lastTree()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Blogpost[] Returns an array of Blogpost objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Blogpost
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}