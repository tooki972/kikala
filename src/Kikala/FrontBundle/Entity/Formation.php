<?php

namespace Kikala\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Formation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Formation
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
     * @Assert\NotBlank(message="Le nom de la formation doit être renseigné!")
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
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 2400,
     *     minHeight = 200,
     *     maxHeight = 2400,
     *     maxSize = "1024k",
     *     maxSizeMessage = "choisissez une photo de moins de 1M",
     *     mimeTypes = {"image/jpeg", "image/jpg"},
     *     mimeTypesMessage = "choisissez une photo en jpg"
     * )
     * @ORM\Column(name="miImage", type="string", length=255)
     */
    private $miImage;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="La date doit être renseigné!")
     * @Assert\DateTime()
     * @ORM\Column(name="dateFormation", type="datetime")
     */
    private $dateFormation;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateCreated", type="date")
     */
    private $dateCreated;

    /**
     * @var string
     * @Assert\NotBlank(message="La lieu doit être renseigné!")
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="La durée doit être renseigné!")
     * @Assert\Time()
     * @ORM\Column(name="duree", type="time")
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text")
     */
    private $descriptif;

    /**
     * @var integer
     * @Assert\NotBlank(message="Descriptif de la formation !")
     * @ORM\Column(name="nbTotal", type="integer")
     */
    private $nbTotal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;
    
    /**
     * @var \Date
     *
     * @ORM\Column(name="cancelDate", type="date", nullable=true)
     */
    private $cancelDate;
    
     /**
     *
     * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\Tag")
     **/
    private $tag;

     /**
     *
     * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\Category")
     **/
    private $category;

    /**
    *
    * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\InscriptionForm",inversedBy="Formation")
    **/
    private $inscriptionForms;
    
     /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255,nullable=true)
     */
    private $filename;

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
     * Set name
     *
     * @param string $name
     * @return Formation
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
     * Set miImage
     *
     * @param string $miImage
     * @return Formation
     */
    public function setMiImage($miImage)
    {
        $this->miImage = $miImage;

        return $this;
    }

    /**
     * Get miImage
     *
     * @return string 
     */
    public function getMiImage()
    {
        return $this->miImage;
    }

    /**
     * Set dateFormation
     *
     * @param \DateTime $dateFormation
     * @return Formation
     */
    public function setDateFormation($dateFormation)
    {
        $this->dateFormation = $dateFormation;

        return $this;
    }

    /**
     * Get dateFormation
     *
     * @return \DateTime 
     */
    public function getDateFormation()
    {
        return $this->dateFormation;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Formation
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Formation
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set duree
     *
     * @param \DateTime $duree
     * @return Formation
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return Formation
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set nbTotal
     *
     * @param integer $nbTotal
     * @return Formation
     */
    public function setNbTotal($nbTotal)
    {
        $this->nbTotal = $nbTotal;

        return $this;
    }

    /**
     * Get nbTotal
     *
     * @return integer 
     */
    public function getNbTotal()
    {
        return $this->nbTotal;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Formation
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
     * Set cancelDate
     *
     * @param \DateTime $cancelDate
     * @return Formation
     */
    public function setCancelDate($cancelDate)
    {
        $this->cancelDate = $cancelDate;

        return $this;
    }

    /**
     * Get cancelDate
     *
     * @return \DateTime 
     */
    public function getCancelDate()
    {
        return $this->cancelDate;
    }

    /**
     * Set tag
     *
     * @param \Kikala\FrontBundle\Entity\Tag $tag
     * @return Formation
     */
    public function setTag(\Kikala\FrontBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Kikala\FrontBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set category
     *
     * @param \Kikala\FrontBundle\Entity\Category $category
     * @return Formation
     */
    public function setCategory(\Kikala\FrontBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Kikala\FrontBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set inscriptionForms
     *
     * @param \Kikala\FrontBundle\Entity\InscriptionForm $inscriptionForms
     * @return Formation
     */
    public function setInscriptionForms(\Kikala\FrontBundle\Entity\InscriptionForm $inscriptionForms = null)
    {
        $this->inscriptionForms = $inscriptionForms;

        return $this;
    }

    /**
     * Get inscriptionForms
     *
     * @return \Kikala\FrontBundle\Entity\InscriptionForm 
     */
    public function getInscriptionForms()
    {
        return $this->inscriptionForms;
    }
      /**
     * Set filename
     *
     * @param string $filename
     * @return Formation
     */
    public function setFilename($Filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }
}
