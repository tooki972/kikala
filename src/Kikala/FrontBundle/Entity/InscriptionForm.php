<?php

namespace Kikala\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionForm
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kikala\FrontBundle\Entity\InscriptionFormRepository")
 */
class InscriptionForm
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
    *
    * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\UserKikologue", inversedBy="inscriptionForms")
    */
    private $user;

    /**
    *
    * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\Formation",inversedBy="inscriptionForms")
    **/
    private $formation;
    
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
     * Set user
     *
     * @param \Kikala\FrontBundle\Entity\UserKikologue $user
     * @return InscriptionForm
     */
    public function setUser(\Kikala\FrontBundle\Entity\UserKikologue $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Kikala\FrontBundle\Entity\UserKikologue 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set formation
     *
     * @param \Kikala\FrontBundle\Entity\Formation $formation
     * @return InscriptionForm
     */
    public function setFormation(\Kikala\FrontBundle\Entity\Formation $formation = null)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \Kikala\FrontBundle\Entity\Formation 
     */
    public function getFormation()
    {
        return $this->formation;
    }
}
