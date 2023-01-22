<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Service\CommentaireService;
use App\Repository\BlogpostRepository;
use App\Repository\CommentaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogpostController extends AbstractController
{
    #[Route('/actualites', name: 'actualites')]

    public function actualites(
        BlogpostRepository $blogpostRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        // Création de la pagination avec paginator

        $data = $blogpostRepository->findBy([], ['id' => 'DESC']);

        $blogposts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('blogpost/actualites.html.twig', [
            'blogposts' => $blogposts,
        ]);
    }
    // Pour la page détail des actualites dans blogpost/detail
    #[Route('/actualites/{slug}', name: 'actualites_detail')]

    public function details(
        Blogpost $blogpost,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository
    ): Response
    {
        $commentaires = $commentaireRepository->findCommentaires($blogpost);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();

            $commentaireService->persistCommentaire($commentaire, $blogpost, null);

            $this->addFlash('success', 'Votre message est bien envoyé, merci. Il sera publié après validation!');
            return $this->redirectToRoute('actualites_detail', ['slug' => $blogpost->getSlug()]);
        }

        return $this->render('blogpost/detail.html.twig', [
            'blogpost' => $blogpost,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
        ]);
    }
}
