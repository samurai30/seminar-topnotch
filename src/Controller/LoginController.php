<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;



/**
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends AbstractController
{
    /**
     * @Rest\Post("/api/login", name="security_login")
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
