<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Entity\Tag;


class FormationController extends Controller 
{

    public function lsFormaAction($page){
    	
    // Affichage de la liste des formations par date de formation et par page (30 formation par page)
    	//1. Aller sur formationRepository et crée deux function que nous avons appelle ici.
    	$maxFormations=30;

        $formations_count = $this->getDoctrine()
        		->getRepository('KikalaFrontBundle:Formation')
                ->countFormation();
                
        $pagination = array(
            'page' => $page,
            'route' => 'kikala_front_lsForma',
            'pages_count' => ceil($formations_count / $maxFormations),
            'route_params' => array()
        );
       
        $twoday=date('Y-m-d', strtotime('2 day ago'));
        
        $formations = $this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')
                ->getList($page, $maxFormations);
        

        return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig', array(
            'formations' => $formations,
            'pagination' => $pagination,
            'twoday' => $twoday
         	)
        );

	}


	public function formaDetailAction($id){

		//requête à la base dans la table formation
		$formation=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->find($id);;
		
	    //création d'un array associatif pour stocker les données
    	$params=array(
    		'formation'=>$formation
    		);

		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig', $params);
	}


}