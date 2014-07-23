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
