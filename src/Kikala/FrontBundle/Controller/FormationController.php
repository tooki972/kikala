<?php

namespace kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormationController extends Controller
{
	public function lsFormaAction(){
		return $this->render('kikalaFrontBundle:Formation:lsForma.html.twig');
	}

	public function formaDetailAction(){
		return $this->render('kikalaFrontBundle:Formation:formaDetail.html.twig');
	}

}