<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response {
        $form = $this->createForm(LoginType::class);
        $form->get('_username')->setData($authenticationUtils->getLastUsername());

        return $this->render('Security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form' => $this->createForm(LoginType::class)->createView(),
        ]);
    }
}