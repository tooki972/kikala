<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Entity\Tag;
use Kikala\FrontBundle\Form\TagType;

class FormationController extends Controller
{
	public function lsFormaAction(){
		return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig');
	}

	public function formaDetailAction(){
		return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig');
	}

	public function TagAction(){
		//instanciation d'un objet
        $tag = new tag();

        //crée une instance de Form
        $tag_form =$this->createForm(new tag, $tag);

        //traitement de requête
        $tag_form->handleRequest($request);
        //si le formulaire est soumis et valide
        if ($tag_form->isValid()){ 
                // Traitement de chaque donnée de notre formulaire


        	//récupération du manager pour sauvegarder l'entity
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($tag);
                //Sauvegarde de l'entity (exécute la requête)
                    $em->flush();

                return $this->redirect($this->generateUrl("kikala_front_formaCreate"));
        }           
            // Creation de la "vue" du formulaire (register.html.twig), à passer dans render();
            $params = array(
            "register_form" => $tag_form->createView()
            );
        
	}
	return $this->render($this->generateUrl("kikala_front_formaCreate", $params));
}