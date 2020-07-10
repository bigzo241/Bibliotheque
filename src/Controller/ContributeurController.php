<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\DocumentRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContributeurController extends AbstractController
{

    /**
     * fonction appelée pour afficher le compte d'un contributeur
     * 
     * @Route("/contributeur", name="compte")
     */
    public function contributeur(CategorieRepository $repoCat, DocumentRepository $repoDoc, VideoRepository $repoVideo)
    {
        $contributeur = $this->getUser();
        
        return $this->render('contributeur/compte.html.twig', ['username' => $contributeur->getUsername()]);
    }
}
