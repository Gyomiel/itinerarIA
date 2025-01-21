<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\DriverRepository;
use App\Repository\OrderRepository;
use App\Repository\RouteRepository;
use App\Repository\TruckRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function adminRoute(Request $request, CustomerRepository $customerRepository, DriverRepository $driverRepository, OrderRepository $orderRepository, RouteRepository $routeRepository, TruckRepository $truckRepository): Response
    {
        return $this->render('adminDashboard.html.twig', [
            'controller_name' => 'HomeController',
            'customer' => $customerRepository->findAll(),
            'driver' => $driverRepository->findAll(),
            'order' => $orderRepository->findAll(),
            'route' => $routeRepository->findAll(),
            'truck' => $truckRepository->findAll()]);
    }

    #[Route('/driver_dashboard', name: 'driverDashboard')]
    public function driverRoute(): Response
    {
        return $this->render('driverDashboard.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
