<?php
/**
 * Created by PhpStorm.
 * User: Samurai
 * Date: 11-03-2019
 * Time: 01:28 AM
 */

namespace App\security;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{



    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     * @return Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
            if($request->isXmlHttpRequest()){
                $array = array( 'success' => true ); // data to return via JSON
                $response = new Response( json_encode( $array ) );
                $response->headers->set( 'Content-Type', 'application/json' );
                return $response;
            }

        return null;

    }

    /**
     * This is called when an interactive authentication attempt fails. This is
     * called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
       if($request->isXmlHttpRequest()){
           $array = array( 'success' => false, 'message' => $exception->getMessage() );
           $response = new Response( json_encode( $array ) );
           $response->headers->set( 'Content-Type', 'application/json' );
           return $response;
       }
       return null;
    }
}