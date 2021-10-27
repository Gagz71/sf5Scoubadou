<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Adopting;
use App\Entity\Advertiser;
use App\Entity\Race;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ScOuBaDoO Corp.')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img src="https://cdn.pixabay.com/photo/2015/03/26/09/54/pug-690566_1280.jpg"> ScOuBaDoO <span class="text-small">ScOuBaDoO</span>')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
            ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Admininistration'),
            MenuItem::linkToCrud('Admininistration', 'fa fa-user', Admin::class),

            MenuItem::section('Race'),
            MenuItem::linkToCrud('Race', 'fa fa-dog', Race::class),


            MenuItem::section('Adoptants'),
            MenuItem::linkToCrud('Adoptants', 'fa fa-user', Adopting::class),


            MenuItem::section('Annonceurs'),
            MenuItem::linkToCrud('Advertiser', 'fa fa-user', Advertiser::class),


            // links to the 'index' action of the Category CRUD controller
            /*MenuItem::linkToCrud('Admininistration', 'fa fa-tags', Admin::class),

            MenuItem::linkToCrud('Adoptant', 'fa fa-tags', Adopting::class),

            MenuItem::linkToCrud('RAce', 'fa fa-tags', Race::class),

            MenuItem::linkToCrud('Advertiser', 'fa fa-tags', User::class),

            MenuItem::linkToDashboard('Home', 'fa fa-home'),

            MenuItem::linkToExitImpersonation('Stop impersonation', 'fa fa-exit'),*/

        ];
    }
}
