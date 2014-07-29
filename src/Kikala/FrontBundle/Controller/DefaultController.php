<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kikala\FrontBundle\Entity\UserKikologue;
use Kikala\FrontBundle\Entity\Formation;
class DefaultController extends Controller
{
	 public function homeAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $nbUser= $em->getRepository('KikalaFrontBundle:UserKikologue')->countUser();  
        $nbFormations= $em->getRepository('KikalaFrontBundle:Formation')->countFormation();  
        return $this->render('KikalaFrontBundle:Default:home.html.twig',array('nbUser' => $nbUser,
            'nbFormations'=>$nbFormations));

    }

    public function legalAction()
    {
        return $this->render('KikalaFrontBundle:Default:legal.html.twig');
    }
     public function aboutAction()
    {
        return $this->render('KikalaFrontBundle:Default:about.html.twig');
    }
}
