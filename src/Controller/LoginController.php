<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class LoginController extends AbstractController
{
    #[Route('')]
    public function login(Request $request, AuthService $authService): Response
    {
        $form = $this->createForm(LoginType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            try {
                $utilisateur = $authService->authenticateUser($data->getNom(), $data->getNum());

                $session = $request->getSession();
                $session->set('id_nom', $utilisateur->getIdNom());

                return $this->forward('App\Controller\ContactsController::index');

            } catch (CustomUserMessageAuthenticationException $exception) {
                echo '<script>alert("Utilisateur inconnu !")</script>';
                $this->addFlash('danger', $exception->getMessage());
            }
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
