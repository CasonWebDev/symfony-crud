<?php

namespace App\Controller;

use App\Entity\TbTecnicos;
use App\Form\TbTecnicosType;
use App\Repository\TbTecnicosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tb/tecnicos")
 */
class TbTecnicosController extends AbstractController
{
    /**
     * @Route("/", name="tb_tecnicos_index", methods={"GET"})
     */
    public function index(TbTecnicosRepository $tbTecnicosRepository): Response
    {
        return $this->render('tb_tecnicos/index.html.twig', [
            'tb_tecnicos' => $tbTecnicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tb_tecnicos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tbTecnico = new TbTecnicos();
        $form = $this->createForm(TbTecnicosType::class, $tbTecnico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tbTecnico);
            $entityManager->flush();

            return $this->redirectToRoute('tb_tecnicos_index');
        }

        return $this->render('tb_tecnicos/new.html.twig', [
            'tb_tecnico' => $tbTecnico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tb_tecnicos_show", methods={"GET"})
     */
    public function show(TbTecnicos $tbTecnico): Response
    {
        return $this->render('tb_tecnicos/show.html.twig', [
            'tb_tecnico' => $tbTecnico,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tb_tecnicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TbTecnicos $tbTecnico): Response
    {
        $form = $this->createForm(TbTecnicosType::class, $tbTecnico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tb_tecnicos_index', [
                'id' => $tbTecnico->getId(),
            ]);
        }

        return $this->render('tb_tecnicos/edit.html.twig', [
            'tb_tecnico' => $tbTecnico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tb_tecnicos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TbTecnicos $tbTecnico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tbTecnico->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tbTecnico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tb_tecnicos_index');
    }
}
