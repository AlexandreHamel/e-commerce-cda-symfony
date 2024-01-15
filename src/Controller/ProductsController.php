<?php

namespace App\Controller;

use App\Entity\Products;
use App\Service\PromotionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produits', name: 'products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('products/index.html.twig');
    }

    #[Route('/{slug}', name:'details')]
    public function details(Products $product, PromotionService $promotionService): Response
    {
        $originalPrice = $product->getPrice();
        $productPromotion = $product->getCategories()->getProductspromotions();

        if ($productPromotion !== null) {
            $discountedPrice = $promotionService->calculateDiscountedPrice($productPromotion, $originalPrice);
        } else {
            $discountedPrice = $originalPrice;
        }

        return $this->render('products/details.html.twig', compact('product', 'originalPrice', 'discountedPrice'));
    }
}