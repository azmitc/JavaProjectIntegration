<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/05/2017
 * Time: 15:36
 */

namespace MyApp\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="PI\GestionRandonneurBundle\Repository\AmisRepository")
 * @ORM\Table(name="Amis")
 */

class Amis
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nom_amis;




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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getNomAmis()
    {
        return $this->nom_amis;
    }

    /**
     * @param string $nom_amis
     */
    public function setNomAmis($nom_amis)
    {
        $this->nom_amis = $nom_amis;
    }

}