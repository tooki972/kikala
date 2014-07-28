<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Symfony\Component\HttpFoundation\Request;
use Kikala\FrontBundle\Entity\UserKikologue;
use Kikala\FrontBundle\Form\UserProfilType;
use \DateTime;
use Kikala\FrontBundle\Form\UserKikologueType;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Entity\Category;
use Kikala\FrontBundle\Entity\Tag;
use Kikala\FrontBundle\Form\FormationType;
use \abeautifulsite\simpleimage;


class UserController extends Controller

{ 
    // 1. Traitement et affichage du formulaire d'inscription, ainsi que sauvegarde des resultats (données) dans la DB
    public function registerAction(Request $request)
    {
        //instanciation d'un objet
        $user = new UserKikologue();

        //crée une instance de Form
        $register_form =$this->createForm(new UserKikologueType, $user);

        //traitement de requête
        $register_form->handleRequest($request);
        //si le formulaire est soumis et valide
            if ($register_form->isValid()){ 
                // Traitement de chaque donnée de notre formulaire
                    // Active
                    $user->setIsActive(true);
                    $user->setDateRegistered(new DateTime());
                    //Kikos
                    $user->setKikos(2);
                    //redCross
                    $user->setRedCross(0);
                    //Photo et Filename
                    if(!empty($user->getPhoto())){
                        $dir = $this->get('kernel')->getRootDir() . '/../web/img/profilpicture';
                        $photo = $user->getPhoto();
                            // comput a random name and try to guess the extension
                            $extension = $photo->guessExtension();
                            $newFilename = base64_encode(microtime()).'.'.$extension;
                            $photo->move($dir, $newFilename);
                            $user->setFilename($newFilename);
                    }
                    //salt
                    $generator = new SecureRandom();
                    $salt = bin2hex($generator->nextBytes(30));
                    $user->setSalt($salt);                    
                    //token
                    $generator = new SecureRandom();
                    $token = bin2hex($generator->nextBytes(30));
                    $user->setToken($token);
                    //hache le mot de passe
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                    $user->setPassword($password);
                    //Roles
                    $user->setRoles(array("ROLE_USER"));
        
                //récupération du manager pour sauvegarder l'entity
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                //Sauvegarde de l'entity (exécute la requête)
                    $em->flush();
                 return $this->redirect($this->generateUrl("kikala_front_homepage"));
                }
        // Creation de la "vue" du formulaire (register.html.twig), à passer dans render();
            $params = array(
            "register_form" => $register_form->createView()
            );
            return $this->render('KikalaFrontBundle:User:register.html.twig', $params);
    }
            

    //2 . Mise en place de l'authentification (Roles et Redirections selon le type d'utilisateur)
    public function loginAction()
    {
 	    $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
	       if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
             $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
            return $this->redirect($this->generateUrl('kikala_front_redirect'));
            } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);   
            return $this->render('KikalaFrontBundle:User:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),  
            'error'         => $error,
            ));
            }
    }

    public function redirectAction(){
        $redirect = $this->getUser()->getRoles();

        if (in_array("ROLE_USER", $redirect)){
            $id=$this->getUser()->getId();
            return $this->redirect($this->generateUrl("kikala_front_kikologue"));
        } else if ($this->get('security.context')->isGranted("ROLE_ADMIN")) {
            return $this->redirect($this->generateUrl("kikala_front_homepage"));
        }
        return $this->render('KikalaFrontBundle:User:home.html.twig');
    }

    public function forgotAction(Request $request)
    {
        $mailsend=false;
        $email=$request->request->get('email');
        //select sur userkikologue
        $mailreposytory=$this->getDoctrine()->getRepository('KikalaFrontBundle:UserKikologue');
//trouve un email dans userkiologue
        $user=$mailreposytory->findOneByEmail($email);
        if(!empty($user)){
            $token = $user->getToken();
            $url=$this->generateUrl("kikala_front_newPass",array('token'=>$token,'email'=>$email),true);
            $message = \Swift_Message::newInstance()
            ->setSubject('mot de pass oublier')
            ->setFrom('kikalabundle@gmail.com')
            ->setTo($email)
            ->setBody("pour recupere votre email veiller cliquer sur ce lien <br/> <a href='$url'>$url</a>",'text/html');
            $this->get('mailer')->send($message);
            $mailsend=true;
        }
       $params =array();
        return $this->render('KikalaFrontBundle:User:forgot.html.twig',$params);
    }

    public function newPassAction(Request $request,$token,$email)
    {
        $mdp=$request->request->get('pass');
        $confirm=$request->request->get('pass2');
        if(!empty($mdp)){
            if($mdp==$confirm){
                $tokenReposytory=$this->getDoctrine()->getRepository('KikalaFrontBundle:UserKikologue');
                $user=$tokenReposytory->findOneByToken($token);
                $user->setPassword($mdp);
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirect($this->generateUrl('kikala_front_homepage'));
            }
        }
        return $this->render('KikalaFrontBundle:User:newPass.html.twig');
    }
   
    public function kikologueAction()
    { //
        $user=$this->getUser();
    

        return $this->render('KikalaFrontBundle:User:kikologue.html.twig',array(
        'user'=>$user));
    }
    

    public function kikoDetailAction()
    {
        return $this->render('KikalaFrontBundle:User:kikoDetail.html.twig');
    }


    public function profilAction(Request $request)
    {
        $user=$this->getUser();
     $profil_form =$this->createForm(new UserProfilType, $user);
     $profil_form->handleRequest($request);
     if ($profil_form->isValid()){ 
             $dir = $this->get('kernel')->getRootDir() . '/../web/img/profilpicture';
                        $photo = $user->getPhoto();
             if($photo){
                            // comput a random name and try to guess the extension
                            $extension = $photo->guessExtension();
                            $newFilename = base64_encode(microtime()).'.'.$extension;
                            $photo->move($dir, $newFilename);
                            $user->setFilename($newFilename);
                        }
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                    }
                 $params = array(
            "profil_form" => $profil_form->createView(),
            "user"=>$this->getUser(),
            );
        return $this->render('KikalaFrontBundle:User:profil.html.twig',$params);
    }

    public function formaCreateAction(Request $request)
    {
        
         $forma = new Formation();
         $tag =new tag();
        //crée une instance de Form
        $formation_form =$this->createForm(new FormationType, $forma);

        //traitement de requête
        $formation_form->handleRequest($request);
        //si le formulaire est soumis et valide
            if ($formation_form->isValid()){ 
                 $forma->setIsActive(true);
                    $forma->setDateCreated(new DateTime());
                        if(!empty($forma->getMiImage())){
                        $dir = $this->get('kernel')->getRootDir() . '/../web/img/formapicture';
                        $MiImage = $forma->getMiImage();
                            // comput a random name and try to guess the extension
                            $extension = $MiImage->guessExtension();
                            $newFilename = base64_encode(microtime()).'.'.$extension;
                            $MiImage->move($dir, $newFilename);
                            $forma->setFilename($newFilename);
                    }
                     //récupération du manager pour sauvegarder l'entity
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($forma);
                //Sauvegarde de l'entity (exécute la requête)
                    $em->flush();
                }
                 $params = array(
            "formation_form" => $formation_form->createView(),
            'category'=>$category,

            );
        return $this->render('KikalaFrontBundle:User:formaCreate.html.twig',$params);
    }

    public function myFormaAction()
    {
        return $this->render('KikalaFrontBundle:User:myForma.html.twig');
    } 

    public function summaryAction()
    {
        return $this->render('KikalaFrontBundle:User:summary.html.twig');
    } 

}
