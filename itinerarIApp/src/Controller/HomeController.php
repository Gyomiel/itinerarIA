<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/admin_dashboard', name: 'adminDashboard')]
    public function adminRoute(): Response
    {
        return $this->render('adminDashboard.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/driver_dashboard', name: 'driverDashboard')]
    public function driverRoute(): Response
    {
        return $this->render('driverDashboard.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
