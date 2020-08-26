<?php

namespace App\Controller;

use App\Repository\DocumentRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    /**
     * methode qui incremente le nombre like et le met a jour sur la page web
     * @Route("/ajax/likeUpdate", name="likeUpdate")
     */
    public function likeUpdate(DocumentRepository $repoDoc, VideoRepository $repoVideo, Request $request)
    {
        if($request->isXmlHttpRequest()){
            if( $request->query->get('rate') == "like" )
            {
                $manager = $this->getDoctrine()->getManager();
                if($request->query->get('type') == "c")
                {
                    $doc = $repoDoc->find($request->query->get('id'));
                    $newLike = $doc->getNbrLike() + 1;
                    $doc->setNbrLike($newLike);
                    $manager->flush();
                }
                if($request->query->get('type') == "v")
                {
                    $video = $repoVideo->find($request->query->get('id'));
                    $newLike = $video->getNbrLike() + 1;
                    $video->setNbrLike($newLike);
                    $manager->flush();
                }
    
                return new JsonResponse($newLike, 200);
            }

            if( $request->query->get('rate') == "unlike" )
            {
                $manager = $this->getDoctrine()->getManager();
                if ($request->query->get('type') == "d") 
                {
                    $doc = $repoDoc->find($request->query->get('id'));
                    $newUnlike = $doc->getNbrUnlike() + 1;
                    $doc->setNbrUnlike($newUnlike);
                    $manager->flush();
                }
                if ($request->query->get('type') == "v") 
                {
                    $video = $repoVideo->find($request->query->get('id'));
                    $newUnlike = $video->getNbrUnlike() + 1;
                    $video->setNbrUnlike($newUnlike);
                    $manager->flush();
                }
        
                return new JsonResponse($newUnlike, 200);
            }
        }
    }
}
