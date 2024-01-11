<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesFormType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/categories', name: 'admin_categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        $categories = $categoriesRepository->findBy([], ['categoryOrder' => 'asc']);
        return $this->render('admin/categories/index.html.twig', compact('categories'));
    }

    #[Route('/ajout', name: 'add')]
    public function add(
        Request $request, 
        EntityManagerInterface $em,  
        SluggerInterface $slugger 
        ): Response
    {
        $category = new Categories();
        $categoryForm = $this->createForm(CategoriesFormType::class, $category);
        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted() && $categoryForm->isValid()){

            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug->lower());

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Catégorie ajouté avec succès');

            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/categories/add.html.twig', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }

    #[Route('/edition{id}', name: 'edit')]
    public function edit(
        Categories $category, 
        Request $request, 
        EntityManagerInterface $em, 
        SluggerInterface $slugger
        ): Response
    {
        $categoryForm = $this->createForm(CategoriesFormType::class, $category);
        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted() && $categoryForm->isValid()){

            $slug = $slugger->slug($category->getName());
            $category->setSlug($slug->lower());

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Catégorie modifié avec succès');

            return $this->redirectToRoute('admin_categories_index');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'categoryForm' => $categoryForm->createView(),
            'category' => $category
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Categories $category, Request $request, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $em->remove($category);
            $em->flush();
        }

        $this->addFlash('success', 'Catégorie supprimée avec succès');

        return $this->redirectToRoute('admin_categories_index');
    }
}