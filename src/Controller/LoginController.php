<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login()
    {

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){

    }
}
