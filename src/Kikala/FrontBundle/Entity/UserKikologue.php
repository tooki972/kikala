<?php

namespace Kikala\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UserKikologue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kikala\FrontBundle\Entity\UserKikologueRepository")
 */
class UserKikologue implements UserInterface, EquatableInterface, \Serializable
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
     * @Assert\NotBlank(message="Le pseudo doit être renseigné!")
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Votre pseudo doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre pseudo ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @var string
     * @Assert\Email(
     *     message = "'{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Le mot de passe doit être renseigné!")
     *
     * @Assert\Length(
     *      min = "4",
     *      max = "255",
     *      minMessage = "Votre mot de passe doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre mot de passe ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Le nom doit être renseigné!")
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Le prénom doit être renseigné!")
     *
     * @Assert\Length(
     *      min = "2",
     *      max = "255",
     *      minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="La date doit être renseigné!")
     * @Assert\DateTime()
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Le gender doit être renseigné!")
     * @Assert\Choice(choices = {"m", "f"}, message = "Choose a valid gender.")
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var string
     * @Assert\NotBlank(message="Le métier doit être renseigné!")
     *
     * @Assert\Length(
     *      min = "5",
     *      max = "255",
     *      minMessage = "Votre métier doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre métier ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="metier", type="text")
     */
    private $metier;

    /**
     * @var string
     * @Assert\NotBlank(message="quelques infos sur vous !")
     *
     * @ORM\Column(name="infoFormateur", type="text")
     */
    private $infoFormateur;

    /**
     * @var string
     * @Assert\NotBlank(message="quelques infos sur vous !")
     *
     * @ORM\Column(name="infoEtudiant", type="text")
     */
    private $infoEtudiant;

    /**
     * @var string
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 1200,
     *     minHeight = 200,
     *     maxHeight = 1200,
     *     maxSize = "1024k",
     *     maxSizeMessage = "choisissez une photo de moins de 1M",
     *     mimeTypes = {"image/jpeg", "image/jpg"},
     *     mimeTypesMessage = "choisissez une photo en jpg"
     * )
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
    *
    * * @ORM\OneToMany (targetEntity="Kikala\FrontBundle\Entity\InscriptionForm", mappedBy="user")
    **/
    private $inscriptionForms;

    /**
    * @var array
    * 
    * @ORM\Column(name="roles", type="array")
    */

    private $roles;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles =Array();
    }
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

     public function getUsername()
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
    /**
     * Add roles
     *
     * @param \Wf3\WikiBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Wf3\WikiBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Wf3\WikiBundle\Entity\Role $roles
     */
    public function removeRole(\Wf3\WikiBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
        //return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        $this->setPassword("");
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->pseudo,
            $this->password,
            $this->salt,
            $this->token
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->pseudo,
            $this->password,
            $this->salt,
            $this->token
        ) = unserialize($serialized);
    }
    
    public function isEqualTo(UserInterface $pseudo){
        if ($this -> id === $pseudo->getId() && $this -> token === $pseudo->getToken()){
            return true;
        }
    return false;
    }


    /**
     * Set roles
     *
     * @param array $roles
     * @return UserKikologue
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Add inscriptionForms
     *
     * @param \Kikala\FrontBundle\Entity\InscriptionForm $inscriptionForms
     * @return UserKikologue
     */
    public function addInscriptionForm(\Kikala\FrontBundle\Entity\InscriptionForm $inscriptionForms)
    {
        $this->inscriptionForms[] = $inscriptionForms;

        return $this;
    }

    /**
     * Remove inscriptionForms
     *
     * @param \Kikala\FrontBundle\Entity\InscriptionForm $inscriptionForms
     */
    public function removeInscriptionForm(\Kikala\FrontBundle\Entity\InscriptionForm $inscriptionForms)
    {
        $this->inscriptionForms->removeElement($inscriptionForms);
    }

    /**
     * Get inscriptionForms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscriptionForms()
    {
        return $this->inscriptionForms;
    }
}
