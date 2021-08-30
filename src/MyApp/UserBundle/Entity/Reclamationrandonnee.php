<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamationrandonnee
 *
 * @ORM\Table(name="reclamationrandonnee", indexes={@ORM\Index(name="id_randonee", columns={"id_randonnee"}), @ORM\Index(name="mail", columns={"id_randonneur"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Reclamationrandonnee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=15, nullable=false)
     */
    private $etat = 'en cours';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000, nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(name="date_envoi", type="string", length=255)
     */

    private $dateEnvoi;
    /**
     * @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->dateEnvoi = date('Y-m-d H:i:s');
    }

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\Randonnee")
     *   @ORM\JoinColumn(name="id_randonnee", referencedColumnName="id")
     */
    private $Randonnee;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     *   @ORM\JoinColumn(name="id_randonneur", referencedColumnName="id")
     */
    private $Randonneur;
    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="admin_traiteur_id",referencedColumnName="id", nullable=true )
     */
    private $AdminTraiteur;


    /**
     * @ORM\Column(type="string",length=2500)
     */
    private $reponse = "Bonjour ,Merci bien pour votre réponse";

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    /**
     * @param \DateTime $dateEnvoi
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;
    }

    /**
     * @return mixed
     */
    public function getRandonnee()
    {
        return $this->Randonnee;
    }

    /**
     * @param mixed $Randonnee
     */
    public function setRandonnee($Randonnee)
    {
        $this->Randonnee = $Randonnee;
    }

    /**
     * @return mixed
     */
    public function getRandonneur()
    {
        return $this->Randonneur;
    }

    /**
     * @param mixed $Randonneur
     */
    public function setRandonneur($Randonneur)
    {
        $this->Randonneur = $Randonneur;
    }

    /**
     * @return mixed
     */
    public function getAdminTraiteur()
    {
        return $this->AdminTraiteur;
    }

    /**
     * @param mixed $AdminTraiteur
     */
    public function setAdminTraiteur($AdminTraiteur)
    {
        $this->AdminTraiteur = $AdminTraiteur;
    }


    /**
     * @return mixed
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param mixed $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }



}

