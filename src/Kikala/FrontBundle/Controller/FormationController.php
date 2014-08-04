<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Entity\Tag;
use Kikala\FrontBundle\Entity\InscriptionForm;
use Kikala\FrontBundle\Entity\KikoTransactionHistory;
use \DateTime;
use Kikala\FrontBundle\Entity\UserKikologue;
use Kikala\FrontBundle\Form\SearchType;

class FormationController extends Controller 
{
    public function lsFormaAction($page){
    	
    // Affichage de la liste des formations par date de formation et par page (30 formation par page)
    	//1. Aller sur formationRepository et crée deux function que nous avons appelle ici.
    	$maxFormations=16;
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
        //gestion des kikos
            $pastFormas=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->giveKikos();
            foreach ($pastFormas as $pastForma ) {
                $creator=$pastForma->getCreator();
            $payer= $this->getDoctrine()->getRepository('KikalaFrontBundle:KikoTransactionHistory')->findBy(array('toUser'=>$creator,'transactionType'=>'formation','formation'=>$pastForma));
            
            if($payer == false){
             
                    $em = $this->getDoctrine()->getManager();
                      $inscri=$em->getRepository('KikalaFrontBundle:InscriptionForm')->countInscriptionForm($pastForma->getId()); 
                      $temp=$pastForma->getDuree();
                      $due=$inscri*$temp;
                      $kikosnow=$creator->getKikos();
                      $creator->setKikos($kikosnow+$due);
                    $transaction= new KikoTransactionHistory();
                    $transaction->setFormation($pastForma);
                     $transaction->setDateTransaction(new DateTime());
                     $transaction->setKikosTransfered($due);
                     $transaction->setTransactionType('formation');
                     $transaction->setToUser($creator);
                     $transaction->setFromUser('eleves');
                     //récupération du manager pour sauvegarder l'entity
                       
                                $em->persist($creator);
                                 $em->persist($transaction);
                            //Sauvegarde de l'entity (exécute la requête)
                                $em->flush();                         
                          }
            }
            //fonction de recherche
            $forma= new formation;
            $Search_form=$this->createForm(new SearchType, $forma);


        return $this->render('KikalaFrontBundle:Formation:lsForma.html.twig', array(
            'formations' => $formations,
            'pagination' => $pagination,
            'twoday' => $twoday,
            "Search_form" => $Search_form->createView()

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
    $securityContext = $this->container->get('security.context');
      if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
        $kikos=$this->getUser()->getKikos();
      	$params=array(
          'user'=>$user,
          'formation'=>$formation,
          'nbInscriptionForm'=>$nbInscriptionForm,
          'quiEtIns'=>$quiEtIns,
          'creator'=>$creator,
          'kikos'=>$kikos,
          'securityContext'=>$securityContext
    		);
      }else{
        $params=array(
          'user'=>$user,
          'formation'=>$formation,
          'nbInscriptionForm'=>$nbInscriptionForm,
          'quiEtIns'=>$quiEtIns,
          'creator'=>$creator,
          'securityContext'=>$securityContext
        );
      }
    $formateur=$this->getDoctrine()->getRepository('KikalaFrontBundle:KikoTransactionHistory')->findBytoUser($user);
     if ($formateur){
      //création d'un array associatif pour stocker les données

    return $this->render('KikalaFrontBundle:Formation:formaDetail.html.twig', $params);

         }else{
                   
             return $this->redirect($this->generateUrl('kikala_front_formaCreate'));  
        }

	}


  public function formaInsAction($id){
    $formation=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->find($id);

    $inscri= new InscriptionForm();
    $inscri->setFormation($formation);
    $inscri->setUser($this->getUser());

    $dure=$formation->getDuree();
    $kikos=$this->getUser()->getKikos();

    $user=$this->getUser()->SetKikos($kikos-$dure);
    
    $transaction= new KikoTransactionHistory();
    $transaction->setDateTransaction(new DateTime());
    $transaction->setKikosTransfered($dure);
    $transaction->setTransactionType('inscription');
    $transaction->setToUser($formation->getCreator());
    $transaction->setFormation($formation);
    $transaction->setFromUser($this->getUser()->getId());
    //récupération du manager pour sauvegarder l'entity 
        $em = $this->getDoctrine()->getManager();
        $em->persist($inscri);
        $em->persist($user);
        $em->persist($transaction);
    //Sauvegarde de l'entity (exécute la requête)
        $em->flush();

    $params=array(
      'id'=>$id
    );
    return $this->redirect($this->generateUrl('kikala_front_formaDetail',$params));    
  }

    public function searchAction(Request $request){
    $twoday=date('Y-m-d', strtotime('2 day ago'));
     
 
      $forma= new formation;
        $Search_form=$this->createForm(new SearchType, $forma);
        $Search_form->handleRequest($request);
        $name=$forma->getName();
        $category=$forma->getCategory();
        $tag=$forma->getTag();
        if(empty($category)&&(empty($name))){
          $formations= $this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->findBy(array('tag'=>$forma->getTag()));
        }elseif(empty($name)){
          $formations= $this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->findBy(array('category'=>$forma->getCategory()));
        }else{
          $formations= $this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->findBy(array('name'=>$forma->getName()));
        }
       return $this->render('KikalaFrontBundle:Formation:search.html.twig', array(
        'formations' => $formations,
        'twoday' => $twoday,
         "Search_form" => $Search_form->createView()
         ));
   }
}