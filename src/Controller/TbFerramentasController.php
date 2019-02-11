<?php

namespace App\Controller;

use App\Entity\TbFerramentas;
use App\Form\TbFerramentasType;
use App\Repository\TbFerramentasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tb/ferramentas")
 */
class TbFerramentasController extends AbstractController
{
    /**
     * @Route("/", name="tb_ferramentas_index", methods={"GET"})
     */
    public function index(TbFerramentasRepository $tbFerramentasRepository): Response
    {
        return $this->render('tb_ferramentas/index.html.twig', [
            'tb_ferramentas' => $tbFerramentasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tb_ferramentas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tbFerramenta = new TbFerramentas();
        $form = $this->createForm(TbFerramentasType::class, $tbFerramenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tbFerramenta);
            $entityManager->flush();

            return $this->redirectToRoute('tb_ferramentas_index');
        }

        return $this->render('tb_ferramentas/new.html.twig', [
            'tb_ferramenta' => $tbFerramenta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{cod_ferramenta}", name="tb_ferramentas_show", methods={"GET"})
     */
    public function show(TbFerramentas $tbFerramenta): Response
    {
        return $this->render('tb_ferramentas/show.html.twig', [
            'tb_ferramenta' => $tbFerramenta,
        ]);
    }

    /**
     * @Route("/{cod_ferramenta}/edit", name="tb_ferramentas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TbFerramentas $tbFerramenta): Response
    {
        $form = $this->createForm(TbFerramentasType::class, $tbFerramenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tb_ferramentas_index', [
                'cod_ferramenta' => $tbFerramenta->getCodFerramenta(),
            ]);
        }

        return $this->render('tb_ferramentas/edit.html.twig', [
            'tb_ferramenta' => $tbFerramenta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{cod_ferramenta}", name="tb_ferramentas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TbFerramentas $tbFerramenta): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tbFerramenta->getCodFerramenta(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tbFerramenta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tb_ferramentas_index');
    }
}
