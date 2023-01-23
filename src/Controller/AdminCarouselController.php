<?php

namespace App\Controller;

use App\Entity\Carousel;
use App\Form\CarouselType;
use App\Repository\CarouselRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/carousel')]
class AdminCarouselController extends AbstractController
{
    #[Route('/', name: 'app_admin_carousel_index', methods: ['GET'])]
    public function index(CarouselRepository $carouselRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $carouselRepository->findBy([],["id" => "DESC"]);
        $carousel = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('admin_carousel/index.html.twig', [
            'carousels' => $carousel,
        ]);
    }

    #[Route('/new', name: 'app_admin_carousel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarouselRepository $carouselRepository): Response
    {
        $carousel = new Carousel();
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carouselRepository->save($carousel, true);

            // mise en place du flash  message
        $this->addFlash('success', 'Carousel correctement ajouté');

            return $this->redirectToRoute('app_admin_carousel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_carousel/new.html.twig', [
            'carousel' => $carousel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_carousel_show', methods: ['GET'])]
    public function show(Carousel $carousel): Response
    {
        return $this->render('admin_carousel/show.html.twig', [
            'carousel' => $carousel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_carousel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carousel $carousel, CarouselRepository $carouselRepository): Response
    {
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carouselRepository->save($carousel, true);
                // mise en place du flash  message
        $this->addFlash('success', 'Carousel correctement modifié');

            return $this->redirectToRoute('app_admin_carousel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_carousel/edit.html.twig', [
            'carousel' => $carousel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_carousel_delete', methods: ['POST'])]
    public function delete(Request $request, Carousel $carousel, CarouselRepository $carouselRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carousel->getId(), $request->request->get('_token'))) {
            $carouselRepository->remove($carousel, true);
                  // mise en place du flash  message
        $this->addFlash('danger', 'Carousel correctement supprimé');
        }

        return $this->redirectToRoute('app_admin_carousel_index', [], Response::HTTP_SEE_OTHER);
    }
}
