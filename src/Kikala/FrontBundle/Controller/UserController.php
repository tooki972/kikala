<?php

namespace Kikala\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Symfony\Component\HttpFoundation\Request;

// Ces lignes vont me permettre de faire appel à une methode Json
use Symfony\Component\HttpFoundation\JsonResponse;

// Ces lignes vont me permettre de faire appel à une methode UsernamePasswordToken et InteractiveLoginEvent pour la redirection à ma page home lors de mon inscription au site
use Symfony\Component\EventDispatcher\EventDispatcher; 
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Kikala\FrontBundle\Entity\UserKikologue;
use Kikala\FrontBundle\Form\UserProfilType;
use Kikala\FrontBundle\Form\UserKikologueType;
use \DateTime;
use Kikala\FrontBundle\Entity\Formation;
use Kikala\FrontBundle\Form\FormationCreateType;
use Kikala\FrontBundle\Entity\Category;
use Kikala\FrontBundle\Entity\Tag;

use Kikala\FrontBundle\Entity\KikoTransactionHistory;
use Kikala\FrontBundle\Form\FormationType;
use \abeautifulsite\SimpleImage;

use Kikala\FrontBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Session\Session; 


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
                        //Enregistre le chemin du fichier temporaire
                        $tmpFileName = $photo->getPathName();
                            // comput a random name and try to guess the extension
                            $extension = $photo->guessExtension();
                            $newFilename = base64_encode(microtime()).'.'.$extension;
                            //Enregistre le fichier temporaire
                            $newPhoto = new SimpleImage($tmpFileName);
                            //Recadre les images et enregistre dans les dossiers
                            $newPhoto->best_fit(250, 300)->save($dir.'/medium/'.$newFilename);
                            $newPhoto->best_fit(150, 150)->save($dir.'/small/'.$newFilename);
                            
                            //$photo->move($dir, $newFilename);
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

                // Pour realiser la redirection dans une page privée home
                    // Here, "public" is the name of the firewall in your security.yml
                    $token = new UsernamePasswordToken($user, $user->getPassword(), "public", $user->getRoles());
                    $this->get("security.context")->setToken($token);

                    // Fire the login event
                    // Logging the user in above the way we do it doesn't do this automatically
                    $event = new InteractiveLoginEvent($request, $token);
                    $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
                   
                    // maybe redirect out here, show me a flashmessage
                    // Flash message configuration : (Note that in our twig we add a for to show our div with message)
                    $this->get('session')->getFlashBag()->add(
                        'notice',
                        'Default message, here you can write blablabla!'
                        );
                return $this->redirect($this->generateUrl('kikala_front_homepage'));
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
    

    public function kikoDetailAction($id)
    {

        $user=$this->getDoctrine()->getRepository('KikalaFrontBundle:UserKikologue')->findOneById($id);
        
        $formations=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->findByCreator($user);
        
        return $this->render('KikalaFrontBundle:User:kikoDetail.html.twig',array(
        'user'=>$user,
        'formations'=>$formations));

    }


    public function profilAction(Request $request)
    {
        $user=$this->getUser();
        $profil_form =$this->createForm(new UserProfilType, $user);
        $profil_form->handleRequest($request);
            if ($profil_form->isValid())
                { 
                $dir = $this->get('kernel')->getRootDir() . '/../web/img/profilpicture';
                        $photo = $user->getPhoto();
                if($photo)
                    {
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
        $tag = new tag();
        $tag_form =$this->createForm(new TagType, $tag);
        $forma = new Formation();

        //crée une instance de Form
        $formation_form =$this->createForm(new FormationCreateType, $forma);
        //traitement de requête
        $formation_form->handleRequest($request);

         
        //si le formulaire est soumis et valide
            if ($formation_form->isValid()){ 

    //print_r($formation_form->getData());

                $forma->setIsActive(true);
                $forma->setDateCreated(new DateTime());
                //récupère l'objet user
                $user=$this->getUser();

                //pour remplir id du crateur de la formation
                $forma->setCreator($user);

                //Photo et Filename
                    if(!empty($forma->getMiImage())){
                        $dir = $this->get('kernel')->getRootDir() . '/../web/img/formapicture';
                        $MiImage = $forma->getMiImage();
                        //Enregistre le chemin du fichier temporaire
                        $tmpFileName = $MiImage->getPathName();
                            // comput a random name and try to guess the extension
                            $extension = $MiImage->guessExtension();
                            $newFilename = base64_encode(microtime()).'.'.$extension;
                            //Enregistre le fichier temporaire
                            $newImage = new SimpleImage($tmpFileName);
                            //Recadre les images et enregistre dans les dossiers
                            $newImage->best_fit(250, 300)->save($dir.'/medium/'.$newFilename);
                            $newImage->best_fit(150, 150)->save($dir.'/small/'.$newFilename);
                            
                            $forma->setFilename($newFilename);
                    }
                    /* Ancienne code pour afficher l'image sans simple image, voir precedement le code avec simpleimage   
                    if(!empty($forma->getMiImage())){
                        $dir = $this->get('kernel')->getRootDir() . '/../web/img/formapicture';
                        $MiImage = $forma->getMiImage();
                            // comput a random name and try to guess the extension
                            $extension = $MiImage->guessExtension();
                            $newFilename = base64_encode(microtime()).'.'.$extension;
                            $MiImage->move($dir, $newFilename);
                            $forma->setFilename($newFilename);
                    }*/
                     //récupération du manager pour sauvegarder l'entity
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($forma);
                //Sauvegarde de l'entity (exécute la requête)
                    $em->flush();
            }
               
            $params = array(
                "tag_form" => $tag_form->createView(),
                "formation_form" => $formation_form->createView(),
            );

        return $this->render('KikalaFrontBundle:User:formaCreate.html.twig',$params);
    }
    
    public function tagCreateAction(Request $request)
    {
        //instanciation d'un objet
        $tag = new tag();
        //crée une instance de Form
        $tag_form =$this->createForm(new TagType, $tag);

        //traitement de requête
        $tag_form->handleRequest($request);
        if ($tag_form->isValid()){ 
            // Traitement de chaque donnée de notre formulaire
            //récupération du manager pour sauvegarder l'entity
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                //Sauvegarde de l'entity (exécute la requête)
                $em->flush();
                $response = new JsonResponse();
                $response->setData(array(
                    'id'=>$tag->getId(),
                    'name'=>$tag->getname(),
                    )
                );
                return $response;
        }    
        $params = array(
                "tag_form" => $tag_form->createView(),
        );
        return $this->render('KikalaFrontBundle:User:tagCreate.html.twig',$params);
    }
    
    public function myFormaAction()
    {
        $user=$this->getUser();

        $formations=$this->getDoctrine()->getRepository('KikalaFrontBundle:Formation')->findByCreator($user);

        return $this->render('KikalaFrontBundle:User:myForma.html.twig',array(
        'user'=>$user,
        'formations'=>$formations));

    } 

    public function formAnnulAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $user->setKikos(0);
        $formations = $em->getRepository('KikalaFrontBundle:Formation')->findByCreator($id);

        $formAnnul = $em->getRepository('KikalaFrontBundle:Formation')->find($id);// crée une variable 
        
        $transaction= new KikoTransactionHistory();
        $transaction->setDateTransaction(new DateTime());
        $transaction->setKikosTransfered(0);
        $transaction->setTransactionType('annulation');
        $transaction->setToUser($user);
        $transaction->setFormation($formAnnul);
        $transaction->setFromUser('kikosmaster');
        $em-> persist($transaction);
        $em-> persist($user);
        $formAnnul->setIsActive(false);
        $em->flush();

        return $this->redirect($this->generateUrl('kikala_front_myForma'));
    }

    public function mesInscriptionsAction()
    {
        $user=$this->getUser();
        $inscriptions=$this->getDoctrine()->getRepository('KikalaFrontBundle:InscriptionForm')->getListInsByUser($user); 
    
        $params=array(
            'inscriptions'=>$inscriptions,
            
        );                     

        return $this->render('KikalaFrontBundle:User:mesInscriptions.html.twig', $params);

    } 

    public function cancelAction($id) // Id c'est l'id de la formation passe dans l'url

    {      
        $user=$this->getUser();
        // On récupères tout l'objet User avec tout ses données
        $inscriptionRepository = $this->getDoctrine()->getRepository('KikalaFrontBundle:InscriptionForm'); // On récupère toute la table inscriptions
        $cancel=$inscriptionRepository->findOneBy(array('id'=>$id, 'user'=>$user)); // FindOneBy sécurité : pour s'assure que le user connecté est le user inscrit a cette formation 
       
        $formation=$cancel->getFormation();

        $kikostran= $this->getDoctrine()->getRepository('KikalaFrontBundle:KikoTransactionHistory')->findOneBy(array(
            'fromUser'=>$user,'transactionType'=>'inscription', 'formation'=>$formation));


        $actkikos=$kikostran->getKikosTransfered();
        
        $updatekikos=$actkikos/2;
        $updatekiko=($updatekikos-0.5);
        $kikos=$user->getKikos();
        $newkikos=$kikos+$updatekiko;
        $user->setKikos($newkikos);

       
        $transaction= new KikoTransactionHistory();
        $transaction->setDateTransaction(new DateTime());
        $transaction->setKikosTransfered($updatekiko);
        $transaction->setTransactionType('remboursement');
        $transaction->setToUser($user);
        $transaction->setFormation($formation);
        $transaction->setFromUser('kikosmaster');

        $em = $this->getDoctrine()->getManager(); // Enregister l'objet dans la variable em
        $em-> remove($cancel); // pour effacer toute la ligne de la table inscriptions
        $em-> persist($transaction);
        $em-> persist($user);

        $em->flush(); // Exécuter

        return $this->redirect($this->generateUrl('kikala_front_mesInscriptions')); // Redirection sur la même page mesInscriptions
    }



}

