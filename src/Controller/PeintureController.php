<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PeintureController extends AbstractController
{
    // Pour la page réalisations
    #[Route('/realisations', name: 'realisations')]

    public function realisations(
        PeintureRepository $peintureRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        // Création de la pagination avec paginator

        $data = $peintureRepository->findBy([], ['id' => 'DESC']);

        $peintures = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('peinture/realisations.html.twig', [
            'peintures' => $peintures,
        ]);
    }

    // pour la page avec le détail des réalisations
    #[Route('/realisations/{slug}', name: 'realisations_detail')]

    public function detail(Peinture $peinture): Response
    {
        return $this->render('peinture/detail.html.twig', [
            'peinture' => $peinture,
        ]);
    }
}
