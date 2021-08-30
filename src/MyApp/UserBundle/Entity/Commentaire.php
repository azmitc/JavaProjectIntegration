<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", uniqueConstraints={@ORM\UniqueConstraint(name="id_com", columns={"id_com"})})
 * @ORM\Entity
 * (repositoryClass="PI\ForumBundle\Repository\Commentaire")
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_com", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCom;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=300, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=300, nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="signals", type="integer", nullable=false)
     */
    private $signals = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnv", type="datetime", nullable=true)
     */
    private $dateenv ;


    /**
     * @return int
     */
    public function getIdCom()
    {
        return $this->idCom;
    }

    /**
     * @param int $idCom
     */
    public function setIdCom($idCom)
    {
        $this->idCom = $idCom;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getSignals()
    {
        return $this->signals;
    }

    /**
     * @param int $signals
     */
    public function setSignals($signals)
    {
        $this->signals = $signals;
    }

    /**
     * @return \DateTime
     */
    public function getDateenv()
    {
        return $this->dateenv;
    }

    /**
     * @param \DateTime $dateenv
     */
    public function setDateenv($dateenv)
    {
        $this->dateenv = $dateenv;
    }





}

