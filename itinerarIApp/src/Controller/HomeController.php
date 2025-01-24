<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\CustomerRepository;
use App\Repository\DriverRepository;
use App\Repository\OrderRepository;
use App\Repository\RouteRepository;
use App\Repository\TruckRepository;
use App\Service\Pagination\PagePaginator;
use App\Service\Pagination\PaginationLinks;
use Doctrine\ORM\EntityManagerInterface;
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
    public function adminRoute(PagePaginator $pagePaginate, PaginationLinks $paginationLinks, EntityManagerInterface $entityManager, Request $request, CustomerRepository $customerRepository, DriverRepository $driverRepository, OrderRepository $orderRepository, RouteRepository $routeRepository, TruckRepository $truckRepository): Response
    {
        $page = $request->query->getInt('page', 1);

        $paginatedPosts = $pagePaginate->paginate($entityManager->getRepository(Order::class)->createQueryBuilder('o'), $page, 8);

        $pagination = $paginationLinks->generateLinks(
            $paginatedPosts['pages'],
            $paginatedPosts['page'],
            $this->generateUrl('adminDashboard')
        );

        $orderMarkers = $orderRepository->findAll();
        $orderInfo = array_map(function ($order) {
            return [
                'id' => $order->getId(),
                'latitude' => $order->getLatitude(),
                'longitude' => $order->getLongitude(),
                'routeId' => $order->getRoute()->getId(),
            ];
        }, $orderMarkers);

        return $this->render('adminDashboard.html.twig', [
            'controller_name' => 'HomeController',
            'posts' => $paginatedPosts['items'],
            'pagination' => $pagination,
            'customer' => $customerRepository->findAll(),
            'driver' => $driverRepository->findAll(),
            'order' => $orderRepository->findAll(),
            'route' => $routeRepository->findAll(),
            'truck' => $truckRepository->findAll(),
            'orderInfo' => $orderInfo,
        ]);
    }

    #[Route('/driver_dashboard', name: 'driverDashboard')]
    public function driverRoute(EntityManagerInterface $entityManager, Request $request, CustomerRepository $customerRepository, DriverRepository $driverRepository, OrderRepository $orderRepository, RouteRepository $routeRepository, TruckRepository $truckRepository): Response
    {
        $selectedRoute = $orderRepository->findBy(['route' => '1'], ['sequence' => 'ASC']);

        $orderMarkers = $orderRepository->findBy(['route' => '1'], ['sequence' => 'ASC']);
        $orderInfo = array_map(function ($order) {
            return [
                'id' => $order->getId(),
                'latitude' => $order->getLatitude(),
                'longitude' => $order->getLongitude(),
            ];
        }, $orderMarkers);

        return $this->render('driverDashboard.html.twig', [
            'controller_name' => 'HomeController',
            'ordersToDisplay' => $selectedRoute,
            'customer' => $customerRepository->findAll(),
            'driver' => $driverRepository->findAll(),
            'order' => $orderRepository->findAll(),
            'route' => $routeRepository->findAll(),
            'truck' => $truckRepository->findAll(),
            'orderInfo' => $orderInfo,
        ]);
    }
}
