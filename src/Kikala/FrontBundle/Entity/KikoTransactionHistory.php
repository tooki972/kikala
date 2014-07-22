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
     *
     * @ORM\ManyToOne (targetEntity="Kikala\FrontBundle\Entity\UserKikologue")
     * @ORM\JoinColumn(nullable=true)
     **/
     private $fromUser;

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
     * Set date
     *
     * @param \DateTime $date
     * @return KikoTransactionHistory
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
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
}
