<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertiesController extends AbstractController
{
    /**
     * @Route("/properties", name="properties")
     */
    public function index()
    {
        return $this->render('properties/index.html.twig', [
            'controller_name' => 'PropertiesController',
        ]);
    }
}
