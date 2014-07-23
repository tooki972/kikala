<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	 public function homeAction()
    {
        return $this->render('KikalaFrontBundle:Default:home.html.twig');
    }
    public function legalAction()
    {
        return $this->render('KikalaFrontBundle:Default:legal.html.twig');
    }
     public function aboutAction()
    {
        return $this->render('KikalaFrontBundle:Default:about.html.twig');
    }
}
