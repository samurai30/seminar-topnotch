<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login",name="security_login")
     */
    public function login(){
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){

    }
}
