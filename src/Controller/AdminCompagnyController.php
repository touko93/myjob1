<?php

namespace App\Controller;

use App\Entity\Compagny;
use App\Form\CompagnyType;
use App\Repository\CompagnyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/compagny')]
class AdminCompagnyController extends AbstractController
{
    #[Route('/', name: 'app_admin_compagny_index', methods: ['GET'])]
    public function index(CompagnyRepository $compagnyRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $compagnyRepository->findBy([],["id" => "DESC"]);
        $compagny = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('admin_compagny/index.html.twig', [
            'compagnies' => $compagny,
        ]);
    }

    #[Route('/new', name: 'app_admin_compagny_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompagnyRepository $compagnyRepository): Response
    {
        $compagny = new Compagny();
        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compagnyRepository->save($compagny, true);

            // mise en place du flash  message
        $this->addFlash('success', 'Entreprise correctement ajouté');

            return $this->redirectToRoute('app_admin_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_compagny/new.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_compagny_show', methods: ['GET'])]
    public function show(Compagny $compagny): Response
    {
        return $this->render('admin_compagny/show.html.twig', [
            'compagny' => $compagny,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_compagny_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compagny $compagny, CompagnyRepository $compagnyRepository): Response
    {
        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compagnyRepository->save($compagny, true);
                 // mise en place du flash  message
        $this->addFlash('success', 'Entreprise correctement modifié');

            return $this->redirectToRoute('app_admin_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_compagny/edit.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_compagny_delete', methods: ['POST'])]
    public function delete(Request $request, Compagny $compagny, CompagnyRepository $compagnyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagny->getId(), $request->request->get('_token'))) {
            $compagnyRepository->remove($compagny, true);
                     // mise en place du flash  message
        $this->addFlash('danger', 'Entreprise correctement supprimé');
        }

        return $this->redirectToRoute('app_admin_compagny_index', [], Response::HTTP_SEE_OTHER);
    }
}
