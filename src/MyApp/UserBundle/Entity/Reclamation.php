<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="PI\MaterielBundle\Repository\Reclamation")
 */
class Reclamation
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
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="typeReclamation", type="string", length=30, nullable=false)
     */
    private $typereclamation;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @ORM\Column(name="date_achat", type="datetime", nullable=false)
     * @Assert\Expression(
     * "this.getDateAchat() > this.getDateEnvoi()",
     *  message="Il faut que la date achat soit inferieure a la date d'aujourd'hui"
     * )
     */
    private $dateAchat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoi", type="datetime", nullable=false)
     */
    private $dateEnvoi = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="validitée", type="integer", nullable=true)
     */

    private $validitée;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\Materiel")
     * @ORM\JoinColumn(referencedColumnName="id",nullable=true,onDelete="SET NULL")
     */
    private $refmateriel;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $idclient;


    /**
     * @ORM\Column(type="string",length=2500)
     */
    private $reponse = "Un adminsatrateur vous aidera dans un bref temps";

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


    /**
     * @ORM\Column(type="string",length=255)
     */
    private $etatReclamation = "en cours";

    /**
     * @return mixed
     */
    public function getEtatReclamation()
    {
        return $this->etatReclamation;
    }

    /**
     * @param mixed $etatReclamation
     */
    public function setEtatReclamation($etatReclamation)
    {
        $this->etatReclamation = $etatReclamation;
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
     * @return string
     */
    public function getTypereclamation()
    {
        return $this->typereclamation;
    }

    /**
     * @param string $typereclamation
     */
    public function setTypereclamation($typereclamation)
    {
        $this->typereclamation = $typereclamation;
    }

    /**
     * @return \DateTime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * @param \DateTime $dateAchat
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;
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
     * @return int
     */
    public function getValiditée()
    {
        return $this->validitée;
    }

    /**
     * @param int $validit�e
     */
    public function setValiditéee($validitée)
    {
        $this->$validitée = $validitée;
    }

    /**
     * @return int
     */
    public function getRefmateriel()
    {
        return $this->refmateriel;
    }

    /**
     * @param int $refmateriel
     */
    public function setRefmateriel($refmateriel)
    {
        $this->refmateriel = $refmateriel;
    }

    /**
     * @return mixed
     */
    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * @param mixed $idclient
     */
    public function setIdclient($idclient)
    {
        $this->idclient = $idclient;
    }


    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true )
     */
    private $idAdmin;

    /**
     * @return mixed
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * @param mixed $idAdmin
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }


}

