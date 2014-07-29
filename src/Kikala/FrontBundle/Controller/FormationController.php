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
		//requête à la base dans la table formation
		$formationReposytory=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation');
		//récupère toutes les données
        $formations=$formationReposytory->findAll();
        //dans un tableau
    	$params=array(
    		'formations'=>$formations,
    		);

        return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig',$params);
		
	}

	public function formaDetailAction(){
		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig');
	}

	
}