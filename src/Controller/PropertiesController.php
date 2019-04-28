<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Featured;
use App\Entity\ScapeProperties;
use App\Entity\ScapeUser;
use App\Form\PropertyFilterType;
use App\Repository\FeaturedRepository;
use App\Repository\PropertyAddressRepository;
use App\Repository\ScapePropertiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdater;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * @Route("/api/appointment/{vendor_id}{propId}", name="appointment")
     * @Security("is_granted(['ROLE_USER','ROLE_VENDOR'])")
     * @param $vendor_id
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param $propId
     * @param EntityManagerInterface $em
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function appointmentBook($vendor_id,Request $request,\Swift_Mailer $mailer,$propId,EntityManagerInterface $em){


        if($request->isMethod("POST")){
            $em->getConnection()->beginTransaction();

            try{
                $vendor = $this->getDoctrine()->getRepository(ScapeUser::class)->find($vendor_id);
                $user = $this->getUser();
                $property = $this->getDoctrine()->getRepository(ScapeProperties::class)->find($propId);
                $user_id = $user->getId();
                if($vendor_id == $user_id){
                    return $this->json('Sorry you cannot book your own property',Response::HTTP_OK);
                }else{
                    $appt = new Appointment();
                    $appt->setScapeUser($user);
                    $appt->setSacpeVendor($vendor);
                    $appt->setScapeProperty($property);
                    $appt->setAppStatus("pending");
                    $message = (new \Swift_Message('Scape-360: Appointment Request'))
                        ->setFrom('samurai3095@gmail.com')
                        ->setTo($user->getUserEmail())
                        ->setBody(
                            $this->renderView(
                                'view_property/bookingEmail.html.twig',
                                ['users' => $user,
                                    'vendor' => $vendor,
                                    'property' => $property]
                            ),
                            'text/html'
                        );
                    $message2 = (new \Swift_Message('Scape-360: Appointment Request'))
                        ->setFrom('samurai3095@gmail.com')
                        ->setTo($vendor->getUserEmail())
                        ->setBody(
                            $this->renderView(
                                'view_property/bookingEmailVendor.html.twig',
                                ['users' => $user,
                                    'vendor' => $vendor,
                                    'property' => $property]
                            ),
                            'text/html'
                        );
                    $mailer->send($message);
                    $mailer->send($message2);
                    $em->persist($appt);
                    $em->flush();
                    $em->getConnection()->commit();
                    return $this->json('Successfully requested appointment',Response::HTTP_OK);
                }
            }catch (Exception $e) {
                $em->getConnection()->rollBack();
                throw $e;}

        }else{
            return $this->redirectToRoute('homepage');
        }


    }


    /**
     * @Route("/api/appointmentCancel/{vendor_id}{propId}", name="cancelAppt")
     * @Security("is_granted(['ROLE_USER','ROLE_VENDOR'])")
     * @param $vendor_id
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param $propId
     * @param EntityManagerInterface $em
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function appointmentCancel($vendor_id,Request $request,\Swift_Mailer $mailer,$propId,EntityManagerInterface $em){
        if($request->isMethod("POST")){

            $em->getConnection()->beginTransaction();
            try {
                $vendor = $this->getDoctrine()->getRepository(ScapeUser::class)->find($vendor_id);
                $user = $this->getUser();
                $property = $this->getDoctrine()->getRepository(ScapeProperties::class)->find($propId);
                $user_id = $user->getId();
                $appt = $this->getDoctrine()->getRepository(Appointment::class)->findOneBy(['scapeUser' => $user_id, 'scapeProperty' => $propId, 'sacpeVendor' => $vendor_id]);

                $em->remove($appt);
                $em->flush();

                $message = (new \Swift_Message('Scape-360: Appointment Cancellation'))
                    ->setFrom('samurai3095@gmail.com')
                    ->setTo($user->getUserEmail())
                    ->setBody(
                        $this->renderView(
                            'view_property/CancelBookEmail.html.twig',
                            ['users' => $user,
                                'vendor' => $vendor,
                                'property' => $property]
                        ),
                        'text/html'
                    );
                $message2 = (new \Swift_Message('Scape-360: Appointment Cancellation'))
                    ->setFrom('samurai3095@gmail.com')
                    ->setTo($vendor->getUserEmail())
                    ->setBody(
                        $this->renderView(
                            'view_property/CancelBookEmailVendor.html.twig',
                            ['users' => $user,
                                'vendor' => $vendor,
                                'property' => $property]
                        ),
                        'text/html'
                    );
                $mailer->send($message);
                $mailer->send($message2);
                $em->getConnection()->commit();
                return $this->json('Successfully requested appointment',Response::HTTP_OK);

            } catch (Exception $e) {
                $em->getConnection()->rollBack();
                throw $e;}
        }else{
            return $this->redirectToRoute('homepage');
        }
    }





}
