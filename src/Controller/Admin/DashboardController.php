<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_USER', message: "Vous n'êtes pas autorisé à accéder à cet endroit !")]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Peinture');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', Blogpost::class);
        yield MenuItem::linkToCrud('Peintures', 'fas fa-palette', Peinture::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Commentaire::class);
        yield MenuItem::linkToCrud('Paramètres', 'fas fa-cog', User::class);
    }
}
