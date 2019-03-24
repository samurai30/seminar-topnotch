<?php

namespace App\Controller;

use App\Entity\ScapeUser;
use App\Form\ScapeUserFPType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ForgotpasswordController extends AbstractController
{

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * ForgotpasswordController constructor.
     * @param FlashBagInterface $flashBag
     */
    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("/forgotpassword", name="forgotpassword",methods={"GET","POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function forgotPassword(Request $request,\Swift_Mailer $mailer)
    {
        if($request->isMethod("POST")){
            $email = $request->request->get('email_user_forgot');
            $users = $this->getDoctrine()->getRepository(ScapeUser::class)->findOneBy(['userEmail' => $email]);

            if($users){
                $token = md5(uniqid($users->getUsername(), true));
                $users->setToken($token);
                $em = $this->getDoctrine()->getManager();
                $em->persist($users);
                $em->flush();
                $message = (new \Swift_Message('Scape-360 Forgot Password'))
                    ->setFrom('samurai3095@gmail.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'forgotpassword/emailMessage.html.twig',
                            ['users' => $users,
                                'token' => $token]
                        ),
                        'text/html'
                    );
                $mailer->send($message);
                $this->flashBag->add('ForgotPassword', 'Check your inbox for further process.');


            }

        }

        return $this->render('forgotpassword/index.html.twig');
    }

    /**
     * @Route("/changePassword/{token}/{id}",name="verifyChangePassword")
     * @param Request $request
     * @param $token
     * @param $id
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function verifyChangePassword(Request $request,$token,$id,UserPasswordEncoderInterface $encoder){

        $user = $this->getDoctrine()->getRepository(ScapeUser::class)->find($id);
        $form = $this->createForm(ScapeUserFPType::class,$user,[
            'action' => $this->generateUrl('verifyChangePassword',[
                'token' => $token,
                'id' => $id
            ])
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($token == $user->getToken()){
                $password = $encoder->encodePassword($user,$user->getPlainPassword());
                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->flashBag->add('success_changed_password','Your Password is updated successfully, Please Login with your new Password');
            }
        }

        return $this->render('forgotpassword/changPassword.html.twig',[
           'token' => $token,
           'id' => $id,
            'form' => $form->createView()
        ]);

    }

}
