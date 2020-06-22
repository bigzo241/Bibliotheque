<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BiblioController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('biblio/index.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

    /**
     * @Route("/initiation", name="initiation")
     */
    public function initiation()
    {
        return $this->render('biblio/initiation.html.twig', []);
    }

    /**
     * @Route("/programmation", name="programmation")
     */
    public function programmation()
    {
        return $this->render('biblio/programmation.html.twig', []);
    }

    /**
     * @Route("/base de données", name="bdd")
     */
    public function bdd()
    {
        return $this->render('biblio/bdd.html.twig', []);
    }

    /**
     * @Route("/coo", name="coo")
     */
    public function coo()
    {
        return $this->render('biblio/coo.html.twig', []);
    }

    /**
     * @Route("/framework", name="framework")
     */
    public function framework()
    {
        return $this->render('biblio/framework.html.twig', []);
    }

    /**
     * @Route("/dévéloppement logiciel", name="dev_logiciel")
     */
    public function devLogiciel()
    {
        return $this->render('biblio/dev_logiciel.html.twig', []);
    }

    /**
     * @Route("/logiciels", name="logiciels")
     */
    public function logiciel()
    {
        return $this->render('biblio/logiciels.html.twig', []);
    }

}
