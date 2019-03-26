<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




/**
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/api/login", name="security_login")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login(Request $request){
        if($request->getMethod()=="POST"){
            return null;
        }
        return $this->redirectToRoute('homepage');

    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){

    }

    /**
     * @Route("/checkRoles",name="CheckRoles")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function checkRoles(){
        $user = $this->getUser();

       return $this->json($user->getRoles(),Response::HTTP_ACCEPTED);

    }
}
