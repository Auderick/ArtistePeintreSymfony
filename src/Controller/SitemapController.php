<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\CategorieRepository;
use App\Repository\PeintureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap')]
    public function index(
        Request $request, 
        PeintureRepository $peintureRepository,
        BlogpostRepository $blogpostRepository,
        CategorieRepository $categorieRepository): Response
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = ['loc' .$this->generateUrl('home')];
        $urls[] = ['loc' . $this->generateUrl('realisations')];
        $urls[] = ['loc' . $this->generateUrl('actualites')];
        $urls[] = ['loc' . $this->generateUrl('portfolio')];
        $urls[] = ['loc' . $this->generateUrl('a_propos')];
        $urls[] = ['loc' . $this->generateUrl('contact')];

        foreach ($peintureRepository->findAll() as $peinture) {
            $urls[] = [
                'loc' => $this->generateUrl('actualites_details', ['slug' => $peinture->getSlug()]),
                'lastmod' => $peinture->getCreatedAt()->format('Y-m-d')
            ];
        }
        foreach ($blogpostRepository->findAll() as $blogpost) {
            $urls[] = [
                'loc' => $this->generateUrl('actualites_details', ['slug' => $blogpost->getSlug()]),
                'lastmod' => $blogpost->getCreatedAt()->format('Y-m-d')
            ];
        }
        foreach ($categorieRepository->findAll() as $categorie) {
            $urls[] = [
                'loc' => $this->generateUrl('actualites_details', ['slug' => $categorie->getSlug()]),
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
            'urls' => $urls,
            'hostnane' => $hostname,
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}