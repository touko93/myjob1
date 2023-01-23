<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/formation')]
class AdminFormationController extends AbstractController
{
    #[Route('/', name: 'app_admin_formation_index', methods: ['GET'])]
    public function index(FormationRepository $formationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $formationRepository->findBy([],["id" => "DESC"]);
        $formation = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('admin_formation/index.html.twig', [
            'formations' => $formation,
        ]);
    }

    #[Route('/new', name: 'app_admin_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormationRepository $formationRepository): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationRepository->save($formation, true);

            // mise en place du flash  message
        $this->addFlash('success', 'Formation correctement ajouté');

            return $this->redirectToRoute('app_admin_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_formation_show', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('admin_formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formation $formation, FormationRepository $formationRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationRepository->save($formation, true);
            $entityManagerInterface->persist($formation);
            //dd($annonce->getImageName());
            $entityManagerInterface->flush();
                      // mise en place du flash  message
        $this->addFlash('success', 'Formation correctement modifié');

            return $this->redirectToRoute('app_admin_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, FormationRepository $formationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $formationRepository->remove($formation, true);
                          // mise en place du flash  message
        $this->addFlash('danger', 'Formation correctement supprimé');
        }

        return $this->redirectToRoute('app_admin_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
