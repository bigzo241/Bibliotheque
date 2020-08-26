<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\SuperCategorie;
use App\Form\CommentaireType;
use App\Repository\CategorieRepository;
use App\Repository\DocumentRepository;
use App\Repository\SuperCategorieRepository;
use App\Repository\VideoRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BiblioController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function indexNoLocale()
    {
        return $this->redirectToRoute('accueil', ['_locale' => 'fr']);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/", name="accueil")
     */
    public function index(CategorieRepository $repoCats, SuperCategorieRepository $reposupercat)
    {
        $cats = $repoCats->findBySuperCategorie(null);
        $supercats = $reposupercat->findAll();

        return $this->render('biblio/index.html.twig', [
            'cats' => $cats, 'supercats' => $supercats
        ]);
    }

    /**
     * @Route("/Accueil/Categorie/{id}", name="categorie")
     * 
     * Undocumented function
     * @param CategorieRepository $repoCat
     * @param Categorie $cat
     * @return void
     */
    public function categorie(Categorie $cat)
    {
        return $this->render('bibloi/cat.html.twig', []);
    }

    /**
     * @Route("/Accueil/{titre}/{id}", name="supercategorie")
     * 
     * Undocumented function
     * @param SuperCategorie $cat
     * @return void
     */
    public function supercategorie(SuperCategorie $cat)
    {
        return $this->render('bibloi/supercat.html.twig', []);
    }


    /**
     * @Route("/{_locale<%app.supported_locales%>}/initiation", name="initiation")
     */
    public function initiation(Request $request, DocumentRepository $repoDoc, 
                                CategorieRepository $repoCat, VideoRepository $repoVideo)
    {
        $comment = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $comment);
        $form->handleRequest($request);

        if($request->isMethod('POST'))
        {
            $comment->setAuteur($request->request->get('auteur'));
            $comment->setContenu($request->request->get('contenu'));
            $comment->setDatePublication(new \DateTime());
            if($request->request->get('type') == "doc")
            {
                $doc1 = $repoDoc->find($request->request->get('id'));
                $comment->setDocument($doc1);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($comment);
                $manager->flush();
            }
            if($request->request->get('type') == "video")
            {
                $video = $repoVideo->find($request->request->get('id'));
                $comment->setVideo($video);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($doc1);
                $manager->flush();
            }

            return $this->redirectToRoute('initiation');
        }

        $categorie = $repoCat->findOneByDesignation('Initiation à l\'informatique');
        $docs = $repoDoc->findBy(
            array('categorie' => $categorie),
            array('dateAjout' => 'desc'),
            null,
            null
        );
        $videos = $repoVideo->findBy(
            array('categorie' => $categorie),
            array('dateAjout' => 'desc'),
            null,
            null
        );

        return $this->render('biblio/initiation.html.twig', [
            'docs' => $docs,
            'videos' => $videos,
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/programmation", name="programmation")
     */
    public function programmation()
    {
        return $this->render('biblio/programmation.html.twig', []);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/base de données", name="bdd")
     */
    public function bdd()
    {
        return $this->render('biblio/bdd.html.twig', []);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/coo", name="coo")
     */
    public function coo()
    {
        return $this->render('biblio/coo.html.twig', []);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/framework", name="framework")
     */
    public function framework()
    {
        return $this->render('biblio/framework.html.twig', []);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/dévéloppement logiciel", name="devLogiciel")
     */
    public function devLogiciel()
    {
        return $this->render('biblio/dev_logiciel.html.twig', []);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/logiciels", name="logiciel")
     */
    public function logiciel()
    {
        return $this->render('biblio/logiciels.html.twig', []);
    }

}
