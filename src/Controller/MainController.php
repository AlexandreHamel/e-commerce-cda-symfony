<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProductsPromotionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategoriesRepository $categoriesRepository, ProductsPromotionsRepository $productsPromotionsRepository): Response
    {

        return $this->render('main/index.html.twig', [
            'categories' => $categoriesRepository->findBy([], 
            ['categoryOrder' => "asc"]),
            'productspromotions' => $productsPromotionsRepository->findAll()
        ]);
    }
}
