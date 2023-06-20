<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Form\PerfilType;
use App\Repository\PerfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/perfil')]
class PerfilController extends AbstractController
{
    #[Route('/', name: 'app_perfil_index', methods: ['GET'])]
    public function index(PerfilRepository $perfilRepository): Response
    {
        return $this->render('perfil/index.html.twig', [
            'perfils' => $perfilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_perfil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PerfilRepository $perfilRepository): Response
    {
        $perfil = new Perfil();
        $form = $this->createForm(PerfilType::class, $perfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perfilRepository->save($perfil, true);

            return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perfil/new.html.twig', [
            'perfil' => $perfil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perfil_show', methods: ['GET'])]
    public function show(Perfil $perfil): Response
    {
        return $this->render('perfil/show.html.twig', [
            'perfil' => $perfil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_perfil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Perfil $perfil, PerfilRepository $perfilRepository): Response
    {
        $form = $this->createForm(PerfilType::class, $perfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perfilRepository->save($perfil, true);

            return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perfil/edit.html.twig', [
            'perfil' => $perfil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perfil_delete', methods: ['POST'])]
    public function delete(Request $request, Perfil $perfil, PerfilRepository $perfilRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perfil->getId(), $request->request->get('_token'))) {
            $perfilRepository->remove($perfil, true);
        }

        return $this->redirectToRoute('app_perfil_index', [], Response::HTTP_SEE_OTHER);
    }
}
