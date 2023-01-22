<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Service\CommentaireService;
use App\Repository\PeintureRepository;
use App\Repository\CommentaireRepository;
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

    public function details(
        Peinture $peinture,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository
    ): Response
    {
        $commentaires = $commentaireRepository->findCommentaires($peinture);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();

            $commentaireService->persistCommentaire($commentaire, null, $peinture);

            $this->addFlash('success', 'Votre message est bien envoyé, merci. Il sera publié après validation!');
            return $this->redirectToRoute('realisations_detail', ['slug' => $peinture->getSlug()]);
        }

        return $this->render('peinture/detail.html.twig', [
            'peinture' => $peinture,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
        ]);
    }
}
