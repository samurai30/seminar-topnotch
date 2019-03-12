<?php

namespace App\Controller;

use App\Repository\FeaturedRepository;
use App\Repository\ScapePropertiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class PropertiesController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * PropertiesController constructor.
     * @param EntityManagerInterface $manager
     * @param PaginatorInterface $paginator
     */
    public function __construct(EntityManagerInterface $manager, PaginatorInterface $paginator)
    {

        $this->manager = $manager;

        $this->paginator = $paginator;
    }

    /**
     * @Route("/properties", name="properties")
     * @param ScapePropertiesRepository $propertiesRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function properties(ScapePropertiesRepository $propertiesRepository,Request $request)
    {
        $em = $this->manager;
        $propQuery = $propertiesRepository->createQueryBuilder('p')
            ->getQuery();



        $props = $this->paginator->paginate($propQuery,
            $request->query->getInt('page',1),1);



        return $this->render('properties/index.html.twig', [
            'properties' => $props
        ]);
    }

    /**
     * @Route("/featured",name="feature_properties")
     * @param FeaturedRepository $featuredRepository
     * @param ScapePropertiesRepository $propertiesRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function featuredProperties(FeaturedRepository $featuredRepository,ScapePropertiesRepository $propertiesRepository){

        $fprop = $featuredRepository->findByType('weekly');

        return $this->render('properties/raw.html.twig', [
            'properties' =>  $fprop
        ]);

    }
}
