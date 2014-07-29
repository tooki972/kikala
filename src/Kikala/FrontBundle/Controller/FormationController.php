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

		
		
		$formationReposytory=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation');
        $formation=$formationReposytory->findAll();
     	/*echo "<pre>";
     	print_r($formation);
     	echo "</pre>";*/
       $name=$formation->name;
    	$params=array(
    		'formation'=>$formation,
    		'name'=>$formation->name);

        return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig',$params);
		
	}

	public function formaDetailAction(){
		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig');
	}

	
}