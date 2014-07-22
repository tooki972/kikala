<?php

namespace kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormationController extends Controller
{
	public function lsFomaAction(){


		return $this->render('kikalaFrontBundle:Default:home.html.twig', $params);
	}
}