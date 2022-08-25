<?php

namespace App\Controller;

use App\Entity\Itineraire;
use App\Form\ItineraireType;
use App\Repository\ItineraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/itineraire")
 */
class ItineraireController extends AbstractController
{
    /**
     * @Route("/", name="app_itineraire_index", methods={"GET"})
     */
    public function index(ItineraireRepository $itineraireRepository): Response
    {
        return $this->render('itineraire/index.html.twig', [
            'itineraires' => $itineraireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_itineraire_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ItineraireRepository $itineraireRepository): Response
    {
        $itineraire = new Itineraire();
        $form = $this->createForm(ItineraireType::class, $itineraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itineraireRepository->add($itineraire);
            return $this->redirectToRoute('app_itineraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('itineraire/new.html.twig', [
            'itineraire' => $itineraire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_itineraire_show", methods={"GET"})
     */
    public function show(Itineraire $itineraire): Response
    {
        return $this->render('itineraire/show.html.twig', [
            'itineraire' => $itineraire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_itineraire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Itineraire $itineraire, ItineraireRepository $itineraireRepository): Response
    {
        $form = $this->createForm(ItineraireType::class, $itineraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itineraireRepository->add($itineraire);
            return $this->redirectToRoute('app_itineraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('itineraire/edit.html.twig', [
            'itineraire' => $itineraire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_itineraire_delete", methods={"POST"})
     */
    public function delete(Request $request, Itineraire $itineraire, ItineraireRepository $itineraireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itineraire->getId(), $request->request->get('_token'))) {
            $itineraireRepository->remove($itineraire);
        }

        return $this->redirectToRoute('app_itineraire_index', [], Response::HTTP_SEE_OTHER);
    }
}
