<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Entity\ClubMatchday;
use App\Entity\Competition;
use App\Entity\CompetitionSeason;
use App\Entity\Season;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'app_admin_dashboard')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->render('/admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Vista Admin')
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('User', 'fas fa-user', User::class),
            MenuItem::subMenu('Football', 'fa fa-futbol')->setSubItems(
                [
                    MenuItem::linkToCrud('Season', 'fas fa-calendar', Season::class),
                    MenuItem::linkToCrud('Competition', 'fas fa-trophy', Competition::class),
                    MenuItem::linkToCrud('Competition Season', 'fas fa-map', CompetitionSeason::class),
                    MenuItem::linkToCrud('Club', 'fas fa-shield-halved', Club::class),
                    MenuItem::linkToCrud('Club Matchday', 'fas fa-calendar-alt', ClubMatchday::class),
                ]
            ),
        ];
    }
}
