<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Contributeur;
use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * recupere le nombre total de telechargement, de like et de unlike pour un contributeur donné
     *
     * @param Contributeur $contributeur l'entité contributeur qui doit etre passée en argument
     * @return array
     */
    public function autreStatistiques(Contributeur $contributeur)
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery("SELECT SUM(v.nbrTelechargement), SUM(v.nbrLike), SUM(v.nbrUnlike)
                                        FROM App\Entity\Video v
                                        WHERE v.contributeur = :username")->setParameter('username', $contributeur);
        $data = $query->getArrayResult();
        return $data;
    }

    /**
     * recupere toutes les videos d'une categorie d'un contributeur
     *
     * @param Categorie $cat entité categorie
     * @param Contributeur $cont entité contributeur 
     * @return array
     */
    public function getVideoBy(Categorie $cat, Contributeur $cont)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.categorie = :val1')
            ->andWhere('v.contributeur = :val2')
            ->setParameters(
                new ArrayCollection(
                    array(new Parameter('val1', $cat), new Parameter('val2', $cont))
                )
            )
            ->orderBy('v.dateAjout', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Video[] Returns an array of Video objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Video
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}