<?php

namespace App\Controller;

use App\Entity\TbOs;
use App\Entity\TbServicos;
use App\Form\TbOsType;
use App\Repository\TbOsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tb/os")
 */
class TbOsController extends AbstractController
{
    /**
     * @Route("/", name="tb_os_index", methods={"GET"})
     */
    public function index(TbOsRepository $tbOsRepository): Response
    {
        return $this->render('tb_os/index.html.twig', [
            'tb_os' => $tbOsRepository->findAll(),
        ]);
    }

    public function sequence($service,$date){
        $idOs = $this->getDoctrine()
                    ->getRepository(TbOs::class)
                    ->findLast();
        $servicoInit = $this->getDoctrine()
                ->getRepository(TbServicos::class)
                ->find($service);
        $idseq = $idOs ? $idOs->getId()+1 : 1;
        $servseq = strtoupper(substr($servicoInit->getTipo(),0,2));
        $dateseq = date_format($date,"Ymd");
        
        return $idseq.$servseq.$dateseq;
    }

    public function total($servico,$tecnico,$ferramentas){
        $ahf = 0;
        $tms = $servico;
        $vht = $tecnico;
        $fer = $ferramentas;
        $tfer = count($ferramentas);

        foreach($fer as $af){
            $ahf += $af->getAluguelHora();
        }

        $total = $tms*$vht+($ahf*$tms)*$tfer;
        
        return $total;
    }

    /**
     * @Route("/new", name="tb_os_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tbO = new TbOs();
        $form = $this->createForm(TbOsType::class, $tbO);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $tbO->setSequence($this->sequence($form['servicos']->getData()->getId(),$form['data_servico']->getData()));
            $tbO->setValorTotal($this->total($form['servicos']->getData()->getTempoMedio(),$form['tecnico']->getData()->getValorHora(),$form['ferramentas']->getData()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tbO);
            $entityManager->flush();

            return $this->redirectToRoute('tb_os_index');
        }

        return $this->render('tb_os/new.html.twig', [
            'tb_o' => $tbO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tb_os_show", methods={"GET"})
     */
    public function show(TbOs $tbO): Response
    {
        return $this->render('tb_os/show.html.twig', [
            'tb_o' => $tbO,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tb_os_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TbOs $tbO): Response
    {
        $form = $this->createForm(TbOsType::class, $tbO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tbO->setSequence($this->sequence($form['servicos']->getData()->getId(),$form['data_servico']->getData()));
            $tbO->setValorTotal($this->total($form['servicos']->getData()->getTempoMedio(),$form['tecnico']->getData()->getValorHora(),$form['ferramentas']->getData()));
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tb_os_index', [
                'id' => $tbO->getId(),
            ]);
        }

        return $this->render('tb_os/edit.html.twig', [
            'tb_o' => $tbO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tb_os_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TbOs $tbO): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tbO->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tbO);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tb_os_index');
    }
}
