<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContributeurController extends AbstractController
{

    /**
     * fonction appelée pour afficher le compte d'un contributeur
     * 
     * @Route("/contributeur", name="contributeur")
     */
    public function contributeur()
    {
        return $this->render('contributeur/contribut.html.twig');
    }
}
