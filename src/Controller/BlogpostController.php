<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Repository\BlogpostRepository;
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

        $data = $blogpostRepository->findAll();

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

    public function detail(Blogpost $blogpost): Response
    {
        return $this->render('blogpost/detail.html.twig', [
            'blogpost' => $blogpost,
        ]);
    }
}