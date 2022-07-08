<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use App\Entity\Actor;
use App\Entity\Director;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToCrud('Film', 'fa fa-file-text', Film::class),
            MenuItem::linkToCrud('Actor', 'fa fa-file-text', Actor::class),
            MenuItem::linkToCrud('Director', 'fa fa-file-text', Director::class),
        ];
    }
}
