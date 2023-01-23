<?php

namespace App\Controller;


use App\Entity\Cartes;
use App\Form\CartesType;
use App\Repository\CartesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/cartes')]
class AdminCartesController extends AbstractController
{
    #[Route('/', name: 'app_admin_cartes_index', methods: ['GET','POST'])]
    public function index(CartesRepository $cartesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $cartesRepository->findBy([],["id" => "DESC"]);
        $cartes = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('admin_cartes/index.html.twig', [
            'cartes' => $cartes,
        ]);
    }

    #[Route('/new', name: 'app_admin_cartes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CartesRepository $cartesRepository): Response
    {
        $carte = new Cartes();
        $form = $this->createForm(CartesType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartesRepository->save($carte, true);

            // mise en place du flash  message
        $this->addFlash('success', 'Carte correctement ajouté');

            return $this->redirectToRoute('app_admin_cartes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cartes/new.html.twig', [
            'carte' => $carte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cartes_show', methods: ['GET'])]
    public function show(Cartes $carte): Response
    {
        return $this->render('admin_cartes/show.html.twig', [
            'carte' => $carte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_cartes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cartes $carte, CartesRepository $cartesRepository): Response
    {
        $form = $this->createForm(CartesType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartesRepository->save($carte, true);
                // mise en place du flash  message
        $this->addFlash('success', 'Carte correctement modifié');

            return $this->redirectToRoute('app_admin_cartes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cartes/edit.html.twig', [
            'carte' => $carte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cartes_delete', methods: ['POST'])]
    public function delete(Request $request, Cartes $carte, CartesRepository $cartesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carte->getId(), $request->request->get('_token'))) {
            $cartesRepository->remove($carte, true);
                 // mise en place du flash  message
        $this->addFlash('danger', 'Carte correctement supprimé');
        }

        return $this->redirectToRoute('app_admin_cartes_index', [], Response::HTTP_SEE_OTHER);
    }
}
