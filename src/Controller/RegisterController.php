<?php

namespace App\Controller;


use App\Entity\ScapeUser;
use App\Entity\ScapeUserAddress;
use App\Form\ScapeUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class RegisterController extends AbstractController
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * RegisterController constructor.
     * @param FlashBagInterface $flashBag
     */
    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("/api/register", name="register")
     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return JsonResponse
     */
    public function register(UserPasswordEncoderInterface $encoder,Request $request,\Swift_Mailer $mailer)
    {
        $user = new ScapeUser();
        $address =new ScapeUserAddress();
        $form = $this->createForm(ScapeUserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $password = $encoder->encodePassword($user,$user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();
            $this->flashBag->add('Registered', 'Registered Successfully');
            $message = (new \Swift_Message('Test Mail'))
                ->setFrom('suyog15122@gmail.com')
                ->setTo('suyog566666@gmail.com')
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'form/emailVerification.html.twig',
                        ['users' => $user]
                    ),
                    'text/html'
                );
            $mailer->send($message);
            return $this->json('worked', Response::HTTP_ACCEPTED);
        }


        /*if($form->isSubmitted() && $form->isValid()){

            return $this->json('worked',Response::HTTP_OK);
        }*/
        $formData = $this->renderView('form/register.html.twig',[
            'form' => $form->createView()
        ]);

        return $this->json(['form' => $formData], Response::HTTP_OK,[],[]);

    }




}
