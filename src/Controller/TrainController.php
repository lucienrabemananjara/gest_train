<?php

namespace App\Controller;

use App\Entity\Train;
use App\Form\TrainType;
use App\Repository\TrainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/train")
 */
class TrainController extends AbstractController
{
    /**
     * @Route("/", name="app_train_index", methods={"GET"})
     */
    public function index(TrainRepository $trainRepository): Response
    {
        return $this->render('train/index.html.twig', [
            'trains' => $trainRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_train_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TrainRepository $trainRepository): Response
    {
        $train = new Train();
        $form = $this->createForm(TrainType::class, $train);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trainRepository->add($train);
            return $this->redirectToRoute('app_train_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('train/new.html.twig', [
            'train' => $train,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_train_show", methods={"GET"})
     */
    public function show(Train $train): Response
    {
        return $this->render('train/show.html.twig', [
            'train' => $train,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_train_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Train $train, TrainRepository $trainRepository): Response
    {
        $form = $this->createForm(TrainType::class, $train);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trainRepository->add($train);
            return $this->redirectToRoute('app_train_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('train/edit.html.twig', [
            'train' => $train,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_train_delete", methods={"POST"})
     */
    public function delete(Request $request, Train $train, TrainRepository $trainRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$train->getId(), $request->request->get('_token'))) {
            $trainRepository->remove($train);
        }

        return $this->redirectToRoute('app_train_index', [], Response::HTTP_SEE_OTHER);
    }
}
