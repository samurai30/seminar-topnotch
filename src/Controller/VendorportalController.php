<?php

namespace App\Controller;

use App\Entity\PropertyImages;
use App\Entity\ScapeProperties;
use App\Form\VendorPropertyAddType;
use App\Repository\PropertyCategoryRepository;
use App\Repository\ScapePropertiesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VendorportalController
 * @package App\Controller
 * @IsGranted("ROLE_VENDOR")
 */
class VendorportalController extends AbstractController
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("/vendorportal/add", name="vendorportal")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $property = new ScapeProperties();
        $form = $this->createForm(VendorPropertyAddType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $username = $user->getUsername();
            $files = $request->files->get('vendor_property_add')['Images'];
            $upload = $this->getParameter('properties_images');
            $uploadPath = $upload.'/'.$username.'/'.$property->getCategory().'/'.$property->getPropName();

            foreach ($files as $file){
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($uploadPath,$filename);
                $images = new PropertyImages();
                $images->setProperty($property);
                $images->setImagePath($filename);
                $em->persist($images);
            }
            $property->setScapeUser($user);
            $property->setPropStatus('unavailable');
            $em->persist($property);
            $em->flush();
            $this->flashBag->add('property_added','successfully added');
        }
        return $this->render('vendorportal/index.html.twig', [
            'form' => $form->createView()
        ]);

    }



}
