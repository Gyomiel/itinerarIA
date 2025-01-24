<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ArtificialIntelligenceController extends AbstractController
{
    private $httpClient;
    private $logger;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    #[Route('/optimize', name: 'optimize', methods: ['GET'])]
    public function index(Request $request)
    {
        $optimizeData = null;

        try {
            $response = $this->httpClient->request('GET', 'http://127.0.0.1:3307/optimize');

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                $errorDetails = $response->getContent(false);
                $this->logger->error('API Error - Status Code: '.$statusCode.' - '.$errorDetails);

                return $this->render('adminDashboard.html.twig', [
                    'error' => 'Error fetching data from external API',
                ]);
            }

            $optimizeData = $response->toArray();

            $this->logger->info('Data received from optimize endpoint: '.json_encode($optimizeData));
        } catch (ClientExceptionInterface|ServerExceptionInterface $httpException) {
            $this->logger->error('API HTTP error: '.$httpException->getMessage());

            return $this->render('adminDashboard.html.twig', [
                'error' => 'Error fetching data from external API: '.$httpException->getMessage(),
            ]);
        } catch (TransportExceptionInterface|\Exception $exception) {
            $this->logger->error('An unexpected error occurred: '.$exception->getMessage());

            return $this->render('adminDashboard.html.twig', [
                'error' => 'An unexpected error occurred: '.$exception->getMessage(),
            ]);
        }

        return $this->redirect('admin_dashboard');
    }
}
