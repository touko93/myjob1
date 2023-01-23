<?php

namespace App\Controller;

use App\Repository\CartesRepository;
use App\Repository\HomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontHomeController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    #[Route('/home', name: 'app_front_home')]
    public function index(HomeRepository $homeRepository, CartesRepository $cartesRepository): Response
    {
        $content = $homeRepository->findOneBy(["isActive"=>true]);
        $cartes = $cartesRepository->findBy(["tag"=>"home"]);
        return $this->render('front_home/index.html.twig', [
            'contenu' => $content,
            'cartes' => $cartes,
        ]);
    }
}
