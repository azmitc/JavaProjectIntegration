<?php

namespace MyApp\UserBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationr
 *
 * @ORM\Table(name="reservationr", indexes={@ORM\Index(name="id_organisateur", columns={"id_user"}), @ORM\Index(name="id_rondonne", columns={"id_rondonne"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Reservationr
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
     * @ORM\Column(name="capacite", type="string", length=100, nullable=false)
     */
    private $capacite;

    /**
     * @var string
     *
     * @ORM\Column(name="nbredejour", type="string", length=100, nullable=false)
     */
    private $nbredejour;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreplace", type="string", length=100, nullable=false)
     */
    private $nombreplace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateres", type="date", nullable=false)
     * @Assert\Date()
     * @Assert\GreaterThan("today",message="dates invalide verifier la validiter de votre date")
     */
    private $dateres;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=100, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="remise", type="string", length=100, nullable=false)
     */
    private $remise;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="string", length=100, nullable=false)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="typerondonne", type="string", length=100, nullable=false)
     */
    private $typerondonne;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmer", type="boolean", nullable=false)
     */
    private $confirmer;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=100, nullable=false)
     */
    private $role;

    /**
     * @var \Randonnee
     *
     * @ORM\ManyToOne(targetEntity="Randonnee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rondonne", referencedColumnName="id")
     * })
     */
    private $idRondonne;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

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
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param string $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
    }

    /**
     * @return string
     */
    public function getNbredejour()
    {
        return $this->nbredejour;
    }

    /**
     * @param string $nbredejour
     */
    public function setNbredejour($nbredejour)
    {
        $this->nbredejour = $nbredejour;
    }

    /**
     * @return string
     */
    public function getNombreplace()
    {
        return $this->nombreplace;
    }

    /**
     * @param string $nombreplace
     */
    public function setNombreplace($nombreplace)
    {
        $this->nombreplace = $nombreplace;
    }

    /**
     * @return \DateTime
     */
    public function getDateres()
    {
        return $this->dateres;
    }

    /**
     * @param \DateTime $dateres
     */
    public function setDateres($dateres)
    {
        $this->dateres = $dateres;
    }

    /**
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param string $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * @param string $remise
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param string $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getTyperondonne()
    {
        return $this->typerondonne;
    }

    /**
     * @param string $typerondonne
     */
    public function setTyperondonne($typerondonne)
    {
        $this->typerondonne = $typerondonne;
    }

    /**
     * @return bool
     */
    public function isConfirmer()
    {
        return $this->confirmer;
    }

    /**
     * @param bool $confirmer
     */
    public function setConfirmer($confirmer)
    {
        $this->confirmer = $confirmer;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return \Randonnee
     */
    public function getIdRondonne()
    {
        return $this->idRondonne;
    }

    /**
     * @param \Randonnee $idRondonne
     */
    public function setIdRondonne($idRondonne)
    {
        $this->idRondonne = $idRondonne;
    }

    /**
     * @return \Utilisateur
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \Utilisateur $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }


}

