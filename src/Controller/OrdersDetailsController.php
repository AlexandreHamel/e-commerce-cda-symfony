<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersDetailsController extends AbstractController
{
    #[Route('/orders/details', name: 'app_orders_details')]
    public function index(): Response
    {
        return $this->render('orders_details/index.html.twig', [
            'controller_name' => 'OrdersDetailsController',
        ]);
    }
}
