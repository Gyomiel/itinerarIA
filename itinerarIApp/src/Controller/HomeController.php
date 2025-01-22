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
        $paginatedPost = $pagePaginate->paginate($entityManager->getRepository(Order::class)->createQueryBuilder('o'), 1, 10);
        $paginatedPosts = $pagePaginate->paginate($entityManager->getRepository(Order::class)->createQueryBuilder('o'), 1, 10);
        $pagination = $paginationLinks->generateLinks(
            $paginatedPosts['pages'],
            $paginatedPost['page'],
            $this->generateUrl('adminDashboard')
        );

        return $this->render('adminDashboard.html.twig', [
            'controller_name' => 'HomeController',
            'posts' => $paginatedPosts['items'],
            'pagination' => $pagination,
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
