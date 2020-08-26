<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Contributeur;
use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Document|null find($id, $lockMode = null, $lockVersion = null)
 * @method Document|null findOneBy(array $criteria, array $orderBy = null)
 * @method Document[]    findAll()
 * @method Document[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
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
        $query = $manager->createQuery("SELECT SUM(d.nbrTelechargement), SUM(d.nbrLike), SUM(d.nbrUnlike)
                                        FROM App\Entity\Document d
                                        WHERE d.contributeur = :username")->setParameter('username', $contributeur);
        $data = $query->getArrayResult();
        return $data;
    }

    /**
     * recupere tous les documents d'une categorie d'un contributeur
     *
     * @param Categorie $cat entité categorie
     * @param Contributeur $cont entité contributeur 
     * @return array
     */    
    public function getDocBy(Categorie $cat, Contributeur $cont)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.categorie = :val1')
            ->andWhere('d.contributeur = :val2')
            ->setParameters(
                new ArrayCollection(
                    array(new Parameter('val1', $cat), new Parameter('val2', $cont))
                ))
            ->orderBy('d.dateAjout', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Document[] Returns an array of Document objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */  
}