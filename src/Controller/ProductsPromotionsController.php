<?php

namespace App\Controller;

use App\Entity\ProductsPromotions;
use App\Form\ProductsPromotionsType;
use App\Repository\ProductsPromotionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products/promotions')]
class ProductsPromotionsController extends AbstractController
{
    #[Route('/', name: 'app_products_promotions_index', methods: ['GET'])]
    public function index(ProductsPromotionsRepository $productsPromotionsRepository): Response
    {
        return $this->render('products_promotions/index.html.twig', [
            'products_promotions' => $productsPromotionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_products_promotions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productsPromotion = new ProductsPromotions();
        $form = $this->createForm(ProductsPromotionsType::class, $productsPromotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productsPromotion);
            $entityManager->flush();

            return $this->redirectToRoute('app_products_promotions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('products_promotions/new.html.twig', [
            'products_promotion' => $productsPromotion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_products_promotions_show', methods: ['GET'])]
    public function show(ProductsPromotions $productsPromotion): Response
    {
        return $this->render('products_promotions/show.html.twig', [
            'products_promotion' => $productsPromotion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_products_promotions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductsPromotions $productsPromotion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductsPromotionsType::class, $productsPromotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_products_promotions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('products_promotions/edit.html.twig', [
            'products_promotion' => $productsPromotion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_products_promotions_delete', methods: ['POST'])]
    public function delete(Request $request, ProductsPromotions $productsPromotion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productsPromotion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($productsPromotion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_products_promotions_index', [], Response::HTTP_SEE_OTHER);
    }
}
