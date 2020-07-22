<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\SuperCategorie;
use App\Repository\CategorieRepository;
use App\Repository\SuperCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BiblioController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function indexNoLocale()
    {
        return $this->redirectToRoute('accueil', ['_locale' => 'en']);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}", name="accueil")
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
    public function initiation()
    {
        return $this->render('biblio/initiation.html.twig', []);
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
     * @Route("/{_locale<%app.supported_locales%>}/dévéloppement logiciel", name="dev_logiciel")
     */
    public function devLogiciel()
    {
        return $this->render('biblio/dev_logiciel.html.twig', []);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/logiciels", name="logiciels")
     */
    public function logiciel()
    {
        return $this->render('biblio/logiciels.html.twig', []);
    }

}
