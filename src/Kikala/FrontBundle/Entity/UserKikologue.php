<?php

namespace Kikala\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserKikologue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kikala\FrontBundle\Entity\UserKikologueRepository")
 */
class UserKikologue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="metier", type="text")
     */
    private $metier;

    /**
     * @var string
     *
     * @ORM\Column(name="infoFormateur", type="text")
     */
    private $infoFormateur;

    /**
     * @var string
     *
     * @ORM\Column(name="infoEtudiant", type="text")
     */
    private $infoEtudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRegistered", type="datetime")
     */
    private $dateRegistered;

    /**
     * @var integer
     *
     * @ORM\Column(name="kikos", type="integer")
     */
    private $kikos;

    /**
     * @var integer
     *
     * @ORM\Column(name="redCross", type="integer")
     */
    private $redCross;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return UserKikologue
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return UserKikologue
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return UserKikologue
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UserKikologue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return UserKikologue
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return UserKikologue
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return UserKikologue
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set metier
     *
     * @param string $metier
     * @return UserKikologue
     */
    public function setMetier($metier)
    {
        $this->metier = $metier;

        return $this;
    }

    /**
     * Get metier
     *
     * @return string 
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * Set infoFormateur
     *
     * @param string $infoFormateur
     * @return UserKikologue
     */
    public function setInfoFormateur($infoFormateur)
    {
        $this->infoFormateur = $infoFormateur;

        return $this;
    }

    /**
     * Get infoFormateur
     *
     * @return string 
     */
    public function getInfoFormateur()
    {
        return $this->infoFormateur;
    }

    /**
     * Set infoEtudiant
     *
     * @param string $infoEtudiant
     * @return UserKikologue
     */
    public function setInfoEtudiant($infoEtudiant)
    {
        $this->infoEtudiant = $infoEtudiant;

        return $this;
    }

    /**
     * Get infoEtudiant
     *
     * @return string 
     */
    public function getInfoEtudiant()
    {
        return $this->infoEtudiant;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return UserKikologue
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return UserKikologue
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return UserKikologue
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return UserKikologue
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set dateRegistered
     *
     * @param \DateTime $dateRegistered
     * @return UserKikologue
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;

        return $this;
    }

    /**
     * Get dateRegistered
     *
     * @return \DateTime 
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    /**
     * Set kikos
     *
     * @param integer $kikos
     * @return UserKikologue
     */
    public function setKikos($kikos)
    {
        $this->kikos = $kikos;

        return $this;
    }

    /**
     * Get kikos
     *
     * @return integer 
     */
    public function getKikos()
    {
        return $this->kikos;
    }

    /**
     * Set redCross
     *
     * @param integer $redCross
     * @return UserKikologue
     */
    public function setRedCross($redCross)
    {
        $this->redCross = $redCross;

        return $this;
    }

    /**
     * Get redCross
     *
     * @return integer 
     */
    public function getRedCross()
    {
        return $this->redCross;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return UserKikologue
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
