<?php

namespace Kikala\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KikoTransactionHistory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class KikoTransactionHistory
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateTransaction", type="date")
     */
    private $dateTransaction;

    /**
     * @var integer
     *
     * @ORM\Column(name="kikosTransfered", type="integer")
     */
    private $kikosTransfered;

    /**
     * @var string
     *
     * @ORM\Column(name="transactionType", type="text")
     */
    private $transactionType;

     /**
     *
     * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\UserKikologue")
     **/
     private $toUser;

     /**
     * @var string
     *
     * @ORM\Column(name="fromUser", type="text")
     */
     private $fromUser;

    /**
     * Get id
     *
     * @return integer 
     */
    /**
     *
     * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\Formation")
     **/
     private $formation;

    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Set kikosTransfered
     *
     * @param integer $kikosTransfered
     * @return KikoTransactionHistory
     */
    public function setKikosTransfered($kikosTransfered)
    {
        $this->kikosTransfered = $kikosTransfered;

        return $this;
    }

    /**
     * Get kikosTransfered
     *
     * @return integer 
     */
    public function getKikosTransfered()
    {
        return $this->kikosTransfered;
    }

    /**
     * Set transactionType
     *
     * @param string $transactionType
     * @return KikoTransactionHistory
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    /**
     * Get transactionType
     *
     * @return string 
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Set dateTransaction
     *
     * @param \DateTime $dateTransaction
     * @return KikoTransactionHistory
     */
    public function setDateTransaction($dateTransaction)
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    /**
     * Get dateTransaction
     *
     * @return \DateTime 
     */
    public function getDateTransaction()
    {
        return $this->dateTransaction;
    }

    /**
     * Set toUser
     *
     * @param \Kikala\FrontBundle\Entity\UserKikologue $toUser
     * @return KikoTransactionHistory
     */
    public function setToUser(\Kikala\FrontBundle\Entity\UserKikologue $toUser = null)
    {
        $this->toUser = $toUser;

        return $this;
    }

    /**
     * Get toUser
     *
     * @return \Kikala\FrontBundle\Entity\UserKikologue 
     */
    public function getToUser()
    {
        return $this->toUser;
    }

   

    

    /**
     * Set fromUser
     *
     * @param string $fromUser
     * @return KikoTransactionHistory
     */
    public function setFromUser($fromUser)
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string 
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set formation
     *
     * @param \Kikala\FrontBundle\Entity\Formation $formation
     * @return KikoTransactionHistory
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
