<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Contributeur;
use App\Entity\SuperCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }


    // public function findByContributeur($contributeur)
    // {
    //     $manager = $this->getEntityManager();
    //     return $manager->createQueryBuilder()
    //         ->select('c.designation', 'd.titre')
    //         ->from($this->getEntityName(), 'c')
    //         ->join('c.Documents', 'd')
    //         ->where('d.contributeur = :val')
    //         ->groupBy('c.designation')
    //         ->setParameter('val', $contributeur)
    //         ->getQuery()
    //         ->getArrayResult();
    // }

    // /**
    //  * @return Categorie[] Returns an array of Categorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
