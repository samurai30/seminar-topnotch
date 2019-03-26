<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VendorportalController
 * @package App\Controller
 * @IsGranted("ROLE_VENDOR")
 */
class VendorportalController extends AbstractController
{
    /**
     * @Route("/vendorportal", name="vendorportal")
     */
    public function index()
    {
        return $this->render('vendorportal/index.html.twig', [
            'controller_name' => 'VendorportalController',
        ]);
    }
}
