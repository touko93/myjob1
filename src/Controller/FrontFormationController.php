<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontFormationController extends AbstractController
{
    #[Route('/front/formation', name: 'app_front_formation')]
    public function index(FormationRepository $formationRepository, PaginatorInterface $paginator,Request $request): Response
    {   
        $query = $formationRepository->findAll();
        // 
        $formations = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );
    
        return $this->render('front_formation/index.html.twig', [
            'controller_name' => 'FrontFormationController',
            'formations'=> $formations,
        ]);
    }
    #[Route('/front/formation/{id}', name: 'app_front_show_formation')]
    public function appFrontShowAnnonce($id, FormationRepository $formationRepository){
        $formation = $formationRepository->find($id);
        return $this->render('front_formation/show.html.twig', [
            'formation' => $formation
        ]);
    }
}
