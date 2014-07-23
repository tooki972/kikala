<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormationController extends Controller
{
	public function lsFormaAction(){
		return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig');
	}

	public function formaDetailAction(){
		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig');
	}

}