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
    * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\UserKikologue")
    */
    private $user;

    /**
    *
    * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\Formation")
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
}
