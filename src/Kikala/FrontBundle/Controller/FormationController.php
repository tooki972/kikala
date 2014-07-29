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

		//Création d'un table 'f' pour classer les formations		
        $query=$formationReposytory->createQueryBuilder('f')
        	->orderBy('f.dateFormation', 'ASC')
        	->getQuery();

        //récupération des données dans $formations	
        	$formations=$query->getResult();
     
        //création d'un array associatif pour stocker les données
    	$params=array(
    		'formations'=>$formations,
    		);

    	//envoi à la vue
        return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig',$params);
		
	}

	public function formaDetailAction(){
		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig');
	}

	
}