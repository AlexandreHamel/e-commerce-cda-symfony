<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\ProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'app_profile_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Profil de l\'utilisateur',
            'user' => $user
        ]);
    }

    #[Route('/commandes', name: 'orders')]
    public function orders(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Commandes de l\'utilisateur',
            
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function account(Users $user, Request $request, EntityManagerInterface $em): Response
    {
        $userForm = $this->createForm(ProfilFormType::class, $user);
        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()){

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre compte a été modifié avec succès');

            return $this->redirectToRoute('app_profile_index');
        }

        return $this->render('profile/edit.html.twig', [
            'userForm' => $userForm->createView(),
            'user' => $user
        ]);
    }

    #[Route('/suppressionProfil/{id}', name: 'selfdelete', methods: ['POST'])]
    public function selfdelete(Users $user, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$this->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à effectuer cette action.');
        }

        $this->container->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();
        
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Votre compte a été supprimé avec succès.');

        return $this->redirectToRoute('main');
    }
}
