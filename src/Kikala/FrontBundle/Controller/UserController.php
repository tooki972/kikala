<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\UserKikologue;
use \DateTime;
use Kikala\FrontBundle\Form\UserKikologueType;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\Security\Core\Util\SecureRandom;

class UserController extends Controller
{
    //affiche et traite le formulaire d'inscription
    public function registerAction()
    {
        $user = new User();
        $register_form =$this->createForm(new UserKikologueType, $user);
        $register_form->handleRequest($request);

        if ($register_form->isValid()){
            //go pour l'inscription
            $user->setIsActive(true);
            $user->setDateRegistered(new DateTime());

            //salt
            $generator = new SecureRandom();
            $salt = bin2hex($generator->nextBytes(30));
            $user->setSalt($salt);
            
            //token
            $generator = new SecureRandom();
            $token = bin2hex($generator->nextBytes(30));
            $user->setToken($token);

            //hache le mot de passe
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            
            //Sauvegarde
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
          }

        $params = array(
            "register_form"=> $register_form->createView()
        );

        return $this->render('KikalaFrontBundle:User:register.html.twig', $params);
    }

    public function loginAction()
    {
 	      $request = $this->getRequest();
      $session = $request->getSession();
      // get the login error if there is one
	     if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
          $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
      } else {
          $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
          $session->remove(SecurityContext::AUTHENTICATION_ERROR);   
             return $this->render('KikalaFrontBundle:User:login.html.twig', array(
          // last username entered by the user
          'last_username' => $session->get(SecurityContext::LAST_USERNAME),  
          'error'         => $error,
      ));
        return $this->render('KikalaFrontBundle:User:login.html.twig');
    }

    public function forgotAction()
    {
        return $this->render('KikalaFrontBundle:User:forgot.html.twig');
    }
    
    public function logoutAction()
    {
        return $this->render('KikalaFrontBundle:User:logout.html.twig');
    }

    public function kikoDetailAction()
    {
        return $this->render('KikalaFrontBundle:User:kikoDetail.html.twig');
    }

    public function kikologueAction()
    {
        return $this->render('KikalaFrontBundle:User:kikologue.html.twig');
    }

    public function profilAction()
    {
        return $this->render('KikalaFrontBundle:User:profil.html.twig');
    }

    public function formaCreateAction()
    {
        return $this->render('KikalaFrontBundle:User:formaCreate.html.twig');
    }

    public function myFormaAction()
    {
        return $this->render('KikalaFrontBundle:User:myForma.html.twig');
    } 

    public function summaryAction()
    {
        return $this->render('KikalaFrontBundle:User:summary.html.twig');
    } 

}
