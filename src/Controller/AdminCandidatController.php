<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/candidat')]
class AdminCandidatController extends AbstractController
{
    #[Route('/', name: 'app_admin_candidat_index', methods: ['GET','POST'])]
    public function index(CandidatRepository $candidatRepository, PaginatorInterface $paginator, Request $request): Response
    {
        if(!is_null($request->request->get("search"))){
            $query = $candidatRepository->search($request->request->get("search"));
        }else{
            $query = $candidatRepository->findBy([],["firstName" => "ASC"]);
        }

        $candidat = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('admin_candidat/index.html.twig', [
            'candidats' => $candidat,
        ]);
    }

    #[Route('/new', name: 'app_admin_candidat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CandidatRepository $candidatRepository): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidat->setUpdatedAt(new DateTimeImmutable());

            
            $candidatRepository->save($candidat, true);

            // mise en place du flash  message
        $this->addFlash('success', 'Candidat correctement ajouté');

            return $this->redirectToRoute('app_admin_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_candidat_show', methods: ['GET'])]
    public function show(Candidat $candidat): Response
    {
        return $this->render('admin_candidat/show.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_candidat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidat $candidat, CandidatRepository $candidatRepository): Response
    {
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidatRepository->save($candidat, true);

            // mise en place du flash  message
        $this->addFlash('success', 'Candidat correctement modifié');

            return $this->redirectToRoute('app_admin_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_candidat/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_candidat_delete', methods: ['POST'])]
    public function delete(Request $request, Candidat $candidat, CandidatRepository $candidatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $candidatRepository->remove($candidat, true);
                // mise en place du flash  message
        $this->addFlash('danger', 'Candidat correctement supprimé');
        }

        return $this->redirectToRoute('app_admin_candidat_index', [], Response::HTTP_SEE_OTHER);
    }
}
