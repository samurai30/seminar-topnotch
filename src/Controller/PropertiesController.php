<?php

namespace App\Controller;

use App\Entity\Featured;
use App\Entity\ScapeProperties;
use App\Form\PropertyFilterType;
use App\Repository\FeaturedRepository;
use App\Repository\ScapePropertiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdater;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/api/properties", name="properties")
     * @param ScapePropertiesRepository $propertiesRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function properties(ScapePropertiesRepository $propertiesRepository,Request $request)
    {
        $propQuery = $propertiesRepository->createQueryBuilder('p')
            ->getQuery();

        $props = $this->paginator->paginate($propQuery,
            $request->query->getInt('page',1),1);


        $properties = $this->render('properties/index.html.twig', [
            'properties' => $props
        ]);

        return $this->json(['property' => $properties], Response::HTTP_ACCEPTED);

    }
    /**
     * @Route("/api/FilterProperties",name="Filter_Properties")
     * @param Request $request
     * @param FilterBuilderUpdater $builderUpdater
     * @return Response
     */

    public function FilterProperties(Request $request,FilterBuilderUpdater $builderUpdater){

        $form = $this->createForm(PropertyFilterType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $filterbuilder = $this->getDoctrine()->getRepository(ScapeProperties::class)->createQueryBuilder('e');
            $builderUpdater->addFilterConditions($form,$filterbuilder);
            $filterbuilder->getQuery()->getResult();
            $props = $this->paginator->paginate($filterbuilder->getQuery(),
                $request->query->getInt('page',1),1);

            return $this->render('properties/index.html.twig',[
                'properties' => $props
            ]);
        }
        return $this->render('properties/raw.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/featured/{type}",name="feature_properties")
     * @param FeaturedRepository $featuredRepository
     * @param $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function featuredProperties(FeaturedRepository $featuredRepository,$type){

        $fprop = $featuredRepository->findByType($type);
        var_dump($fprop);die;
        return $this->render('properties/raw.html.twig', [
            'properties' =>  $fprop
        ]);



    }


}
