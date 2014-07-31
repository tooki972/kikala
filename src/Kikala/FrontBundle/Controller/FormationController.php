<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Entity\Tag;
use Kikala\FrontBundle\Entity\InscriptionForm;

class FormationController extends Controller 
{
    public function lsFormaAction($page){
    	
    // Affichage de la liste des formations par date de formation et par page (30 formation par page)
    	//1. Aller sur formationRepository et crée deux function que nous avons appelle ici.
    	$maxFormations=6;

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
        $user=$this->getUser();
        $em = $this->getDoctrine()->getEntityManager();
        //requête à la base dans la table formation
        $formation=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->find($id);
        $nbInscriptionForm=$em->getRepository('KikalaFrontBundle:InscriptionForm')->countInscriptionForm($formation); 
	    $quiEtIns= $this->getDoctrine()->getRepository('KikalaFrontBundle:InscriptionForm')->findBy(array('user'=>$user,'formation'=>$formation));
        $creator=$formation->getCreator();
	    //création d'un array associatif pour stocker les données
    	$params=array(
            'user'=>$user,
    		'formation'=>$formation,
            'nbInscriptionForm'=>$nbInscriptionForm,
            'quiEtIns'=>$quiEtIns,
            'creator'=>$creator
    		);

		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig', $params);
	}
    public function formaInsAction($id){
        $formation=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->find($id);
        $inscri= new Inscriptionform();
        $inscri->setFormation($formation);
        $inscri->setUser($this->getUser());
        //récupération du manager pour sauvegarder l'entity
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($inscri);
        //Sauvegarde de l'entity (exécute la requête)
            $em->flush();
            $this->getUser();

            $params=array(
                'id'=>$id);

        return $this->redirect($this->generateUrl('kikala_front_formaDetail',$params));    
    }

}