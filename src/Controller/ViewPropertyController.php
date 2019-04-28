<?php

namespace App\Controller;

use App\Entity\ScapeProperties;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewPropertyController extends AbstractController
{
    /**
     * @Route("/view/property/{id}", name="view_property")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($id)
    {
        $prop = $this->getDoctrine()->getRepository(ScapeProperties::class)->find($id);

        return $this->render('view_property/index.html.twig', [
            'property' => $prop
        ]);
    }
}
