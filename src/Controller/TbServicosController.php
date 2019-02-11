<?php

namespace App\Controller;

use App\Entity\TbServicos;
use App\Form\TbServicosType;
use App\Repository\TbServicosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tb/servicos")
 */
class TbServicosController extends AbstractController
{
    /**
     * @Route("/", name="tb_servicos_index", methods={"GET"})
     */
    public function index(TbServicosRepository $tbServicosRepository): Response
    {
        return $this->render('tb_servicos/index.html.twig', [
            'tb_servicos' => $tbServicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tb_servicos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tbServico = new TbServicos();
        $form = $this->createForm(TbServicosType::class, $tbServico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tbServico);
            $entityManager->flush();

            return $this->redirectToRoute('tb_servicos_index');
        }

        return $this->render('tb_servicos/new.html.twig', [
            'tb_servico' => $tbServico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tb_servicos_show", methods={"GET"})
     */
    public function show(TbServicos $tbServico): Response
    {
        return $this->render('tb_servicos/show.html.twig', [
            'tb_servico' => $tbServico,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tb_servicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TbServicos $tbServico): Response
    {
        $form = $this->createForm(TbServicosType::class, $tbServico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tb_servicos_index', [
                'id' => $tbServico->getId(),
            ]);
        }

        return $this->render('tb_servicos/edit.html.twig', [
            'tb_servico' => $tbServico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tb_servicos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TbServicos $tbServico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tbServico->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tbServico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tb_servicos_index');
    }
}
