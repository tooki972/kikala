<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registerAction()
    {
        return $this->render('KikalaFrontBundle:User:register.html.twig');
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
