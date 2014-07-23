<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	 public function indexAction()
    {
        return $this->render('KikalaFrontBundle:Default:index.html.twig');
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
