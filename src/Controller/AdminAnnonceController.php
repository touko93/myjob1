<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/annonce')]
class AdminAnnonceController extends AbstractController
{
    #[Route('/', name: 'app_admin_annonce_index', methods: ['GET', 'POST'])]
    public function index(AnnonceRepository $annonceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        if(!is_null($request->request->get("search"))){
            $query = $annonceRepository->search($request->request->get("search"));
        }else{
            $query = $annonceRepository->findBy([],["title" => "ASC"]);
        }
        
        
        $annonce = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('admin_annonce/index.html.twig', [
            'annonces' => $annonce,

        ]);
    }

    #[Route('/new', name: 'app_admin_annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceRepository->save($annonce, true);

        // mise en place du flash  message
        $this->addFlash('success', 'Annonce correctement ajouté');

            return $this->redirectToRoute('app_admin_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce): Response
    {
        return $this->render('admin_annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $form = $this->createForm(AnnonceType::class, $annonce, ["imageRequired"=>false]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $annonce->setImageName("coucou");
            $entityManagerInterface->persist($annonce);
            //dd($annonce->getImageName());
            $entityManagerInterface->flush();
            // mise en place du flash  message
            $this->addFlash('success', 'Annonce correctement modifié');

            return $this->redirectToRoute('app_admin_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_annonce_delete', methods: ['POST'])]
    public function delete(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $annonceRepository->remove($annonce, true);
              // mise en place du flash  message
        $this->addFlash('danger', 'Annonce correctement supprimé');
        }

        return $this->redirectToRoute('app_admin_annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}
