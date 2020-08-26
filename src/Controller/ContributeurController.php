<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Document;
use App\Entity\SuperCategorie;
use App\Entity\Video;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\DocumentRepository;
use App\Repository\SuperCategorieRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContributeurController extends AbstractController
{

    /**
     * fonction appelée pour afficher le compte d'un contributeur
     * 
     * @Route("/contributeur", name="compte")
     */
    public function contributeur(CommentaireRepository $repoComm, SuperCategorieRepository $repoSuperCat, 
                                CategorieRepository $repoCat, DocumentRepository $repoDoc, 
                                VideoRepository $repoVideo, 
                                Request $request)
    {
        // recuperation de l'utilisateur courant
        $contributeur = $this->getUser();
        // les simples categories
        $simpleCat = $repoCat->findBySuperCategorie(null);
        // les supercategories
        $superCat = $repoSuperCat->findAll();
        // la categorie courante
        $categorie = $repoCat->findOneByDesignation($request->query->get('cat'));

        // nombre total de commentaire
        $nbrCommDoc = $repoComm->nbrCommDoc($contributeur->getId());
        $nbrCommVideo = $repoComm->nbrCommVideo($contributeur->getId());
        // nombre total de téléchargement, like et unlik des documents
        $downLikeUnlike = $repoDoc->autreStatistiques($contributeur);
        // nombre total de téléchargement, like et unlik des videos
        $downLikeUnlike2 = $repoVideo->autreStatistiques($contributeur);
        
        // les documents
        $docs1 = $repoDoc->findByContributeur($contributeur); // tous les documents d'un contributeur
        $docs2 = $repoDoc->getDocBy($categorie, $contributeur); // tous les documents d'une categorie d'un contributeur
        // les videos
        $videos1 = $repoVideo->findByContributeur($contributeur); // toutes les videos d'un contributeur
        $videos2 = $repoVideo->getVideoBy($categorie, $contributeur); // toutes les videos d'une categorie d'un contributeur
        
        return $this->render('contributeur/compte.html.twig', [
            'username' => $contributeur->getUsername(), // nom d'utilisateur du contributeur
            'cat' => $request->query->get('cat'), // infos pour le menu des categories et des super categories
            'superCats' => $superCat,
            'simpleCats' => $simpleCat,
            'docs1' => $docs1, // infos sur les ressources
            'docs2' => $docs2,
            'videos1' => $videos1,
            'videos2' => $videos2,
            'nbrCommDocs' => $nbrCommDoc, // infos des statistiques
            'nbrCommVideos' => $nbrCommVideo,
            'downLikeUnlike' => $downLikeUnlike,
            'downLikeUnlike2' => $downLikeUnlike2,
        ]);
    }

    /**
     * @Route("/contributeur/ajout de document", name="ajoutDoc")
     */
    public function ajoutDoc(Request $request, CategorieRepository $repoCat, String $imageDir)
    {
        if($request->isMethod('POST')){
            $categorie = $repoCat->findOneByDesignation($request->request->get("cat"));
            $contributeur = $this->getUser();

            $newName = bin2hex(random_bytes(6)).'.'.$request->files->get('doc')->guessExtension();
            try {
                $request->files->get('doc')->move($imageDir."/".$categorie, $newName);
            } catch (FileException $e) {
                //throw $th;
            }

            $doc = new Document();
            $doc->setTitre($newName)
                ->setLangue($request->request->get("lang"))
                ->setDescription($request->request->get("descrip"))
                ->setCategorie($categorie)
                ->setContributeur($contributeur)
                ->setDateAjout(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($doc);
            $manager->flush();
        }
        
        return new RedirectResponse($this->generateUrl('compte', ['cat' => $request->request->get("cat")]));
    }

    /**
     * @Route("/contributeur/ajout de video", name="ajoutVideo")
     */
    public function ajoutVideo(Request $request, CategorieRepository $repoCat, String $videoDir)
    {
        if($request->isMethod('POST')){
            $categorie = $repoCat->findOneByDesignation($request->request->get("cat"));
            $contributeur = $this->getUser();

            $newName = bin2hex(random_bytes(6)).'.'.$request->files->get('doc')->guessExtension();
            try {
                $request->files->get('doc')->move($videoDir."/".$categorie, $newName);
            } catch (FileException $e) {
                //throw $th;
            }

            $video = new Video();
            $video->setTitre($newName)
                ->setDescription($request->request->get("descrip"))
                ->setCategorie($categorie)
                ->setContributeur($contributeur)
                ->setDateAjout(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($video);
            $manager->flush();
        }
        
        return new RedirectResponse($this->generateUrl('compte', ['cat' => $request->request->get("cat")]));
    }

    /**
     * @Route("/contributeur/action/update", name="modifRes")
     */
    public function modifRessource(Request $request, DocumentRepository $repoDoc, VideoRepository $repoVideo)
    {
        if($request->isMethod("POST"))
        {
            if($request->request->get('type') == "doc")
            {
                $manager = $this->getDoctrine()->getManager();
                $doc = $repoDoc->find($request->request->get('id'));
                $doc->setDescription($request->request->get('descrip'));
                $manager->flush();
            }
            if($request->request->get('type') == "video")
            {
                $manager = $this->getDoctrine()->getManager();
                $video = $repoVideo->find($request->request->get('id'));
                $video->setDescription($request->request->get('descrip'));
                $manager->flush();
            }
            return new RedirectResponse($this->generateUrl('compte', ['cat' => $request->request->get("cat")]));
        }
    }

    /**
     * @Route("/contributeur/action/del", name="suppRes")
     */
    public function suppRessource(Request $request, DocumentRepository $repoDoc, VideoRepository $repoVideo)
    {
        $manager = $this->getDoctrine()->getManager();
        if($request->query->get('type') == "doc")
        {
            $manager->remove($repoDoc->find($request->query->get('id')));
            $manager->flush();

            return new RedirectResponse($this->generateUrl('compte', ['cat' => $request->query->get("cat")]));
        }

        if($request->query->get('type') == "video")
        {
            $manager->remove($repoVideo->find($request->query->get('id')));
            $manager->flush();

            return new RedirectResponse($this->generateUrl('compte', ['cat' => $request->query->get("cat")]));
        }
    }
}
