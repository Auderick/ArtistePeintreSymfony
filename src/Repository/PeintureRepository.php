<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Peinture>
 *
 * @method Peinture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peinture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peinture[]    findAll()
 * @method Peinture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeintureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peinture::class);
    }

    public function save(Peinture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Peinture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    // Pour récupérer les trois dernières peintures
    /**
     * @return Peinture[] Returns an array of Peinture objects
     */   
     public function lastTree()
    {
        return $this->createQueryBuilder('p')
                    ->orderBy('p.id', 'DESC')
                    ->setMaxResults(3)
                    ->getQuery()
                    ->getResult();
    }

    // Pour récupérer les trois dernières peintures
    /**
     * @return Peinture[] Returns an array of Peinture objects
     */
    public function findAllPortfolio(Categorie $categorie): array
    {
        return $this->createQueryBuilder('p')
                    ->where(':categorie MEMBER OF p.categorie')
                    ->setParameter('categorie', $categorie)
                    ->getQuery()
                    ->getResult()
        ;
    }
}