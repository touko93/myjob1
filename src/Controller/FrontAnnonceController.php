<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontAnnonceController extends AbstractController
{
    #[Route('/front/annonce', name: 'app_front_annonce')]
    public function index(AnnonceRepository $annonceRepository, PaginatorInterface $paginator,Request $request): Response
    {   
        $query = $annonceRepository->findAll();
        // 
        $annonces = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );
    
        return $this->render('front_annonce/index.html.twig', [
            'controller_name' => 'FrontAnnonceController',
            'annonces'=> $annonces,
        ]);
    }
    #[Route('/front/annonce/{id}', name: 'app_front_show_annonce')]
    public function appFrontShowAnnonce($id, AnnonceRepository $annonceRepository){
        $annonce = $annonceRepository->find($id);
        return $this->render('front_annonce/show.html.twig', [
            'annonce' => $annonce
        ]);
    }
}
