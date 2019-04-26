<?php

namespace App\Controller;

use App\Entity\Featured;
use App\Entity\ScapeProperties;
use App\Form\PropertyFilterType;
use App\Repository\FeaturedRepository;
use App\Repository\PropertyAddressRepository;
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
     * @var FilterBuilderUpdater
     */
    private $builderUpdater;

    /**
     * PropertiesController constructor.
     * @param EntityManagerInterface $manager
     * @param PaginatorInterface $paginator
     * @param FilterBuilderUpdater $builderUpdater
     */
    public function __construct(EntityManagerInterface $manager, PaginatorInterface $paginator,FilterBuilderUpdater $builderUpdater)
    {

        $this->manager = $manager;

        $this->paginator = $paginator;
        $this->builderUpdater = $builderUpdater;
    }

    /**
     * @Route("/api/properties", name="properties")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function properties(Request $request)
    {
        $filterbuilder = $this->getDoctrine()->getRepository(ScapeProperties::class)->createQueryBuilder('e')
        ->select('e')
            ->where('e.propStatus = :val')
            ->setParameter('val', 'available');


        $form = $this->createForm(PropertyFilterType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->builderUpdater->addFilterConditions($form,$filterbuilder);
        }
            $propQuery = $filterbuilder->getQuery();
            $props = $this->paginator->paginate($propQuery,
                $request->query->getInt('page',1),3);

            $properties = $this->render('properties/index.html.twig',[
                'properties' => $props,
            ]);

            return $this->json(['property' => $properties], Response::HTTP_ACCEPTED);


    }

    public function getFilterForm(){
        $form = $this->createForm(PropertyFilterType::class);

        return $this->render('form/filterPropertyForm.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/test")
     * @param FeaturedRepository $repository
     * @return Response
     */
    public function getFeaturedProp(FeaturedRepository $repository)
    {

        $properties = $repository->getFeatured('Daily');

        return $this->render('homepage/featured.html.twig',
            [
                'properties' => $properties
            ]);
    }




}
