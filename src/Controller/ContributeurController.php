<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\DocumentRepository;
use App\Repository\SuperCategorieRepository;
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
    public function contributeur(CategorieRepository $repoCat, SuperCategorieRepository $reposupercat)
    {
        $contributeur = $this->getUser();
        $cats = $repoCat->getCatsInfo($contributeur->getUsername());
        $supercats = $reposupercat->findAll();
        
        return $this->render('contributeur/compte.html.twig', ['username' => $contributeur->getUsername(), 
            'menucats' => $cats, 'menusupercats' => $supercats
        ]);
    }
}
