<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Entity\Tag;


class FormationController extends Controller
{
	public function lsFormaAction(){
		return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig');
	}

	public function formaDetailAction(){
		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig');
	}

	
}