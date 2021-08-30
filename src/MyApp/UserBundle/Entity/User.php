<?php

/**
 * Created by PhpStorm.
 * User: Othman Ben Jemaa
 * Date: 08/03/2017
 * Time: 18:13
 */
namespace MyApp\UserBundle \Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity (repositoryClass="PI\GestionRandonneurBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 * @ORM\Table(name="utilisateur")
 */

class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */

    protected $id;



    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir un nombre"
     * )
     */


    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/")
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prenom ne peut pas contenir un nombre"
     * )
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=8, nullable=true)
     * @Assert\Length(
     *      min = 8,
     *     max = 8,
     *      exactMessage = "Le numero doit etre composé de {{ limit }} chiffres ",
     *
     * )
     *
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=8, nullable=true)
     * @Assert\Length(
     *      min = 8,
     *     max = 8,
     *      exactMessage = "Le CIN doit etre composé de {{ limit }} chiffres ",
     *
     * )
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=30, nullable=true)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=30, nullable=true)
     */
    private $pwd;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=30, nullable=true)
     */
    private $role;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @Assert\Range(
     *      min = "today - 60 years",
     *      max = "today - 18 years"
     * )
     */

    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=200, nullable=true)
     */
    private $photo;

    /**
     * @var integer
     *
     * @ORM\Column(name="connected", type="integer", nullable=true)
     */
    private $connected = '0';

    /**
     * @var string
     *@Assert\NotBlank()
     * @ORM\Column(name="adresse", type="string", length=30, nullable=true)
     */
    private $adresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="disponibilité", type="integer", nullable=true)
     */
    private $disponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="competance", type="string", length=30, nullable=true)
     */
    private $competance;

    /**
     * @var string
     *
     * @ORM\Column(name="typeOrganisateur", type="string", length=30, nullable=true)
     */
    private $typeorganisateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="pt_fidel", type="integer", nullable=true)
     */
    private $ptFidel = '0';


    /**
     * @ORM\Column(name="join_date", type="string", length=255)
     */

    private $joinDate;
    /**
     * @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->joinDate = date('Y-m-d H:i:s');
    }


    /**
     * @var string
     *
     * @ORM\Column(name="typeAgence", type="string", length=30, nullable=true)
     */
    private $typeagence;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="imageName",nullable=true)
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookID;

    private $facebookAccessToken;
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return User
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return User
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }


    /**
     * @return \DateTime
     */
    public function getJoinDate()
    {
        return $this->joinDate;
    }




    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return int
     */
    public function getConnected()
    {
        return $this->connected;
    }

    /**
     * @param int $connected
     */
    public function setConnected($connected)
    {
        $this->connected = $connected;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getCompetance()
    {
        return $this->competance;
    }

    /**
     * @param string $competance
     */
    public function setCompetance($competance)
    {
        $this->competance = $competance;
    }

    /**
     * @return int
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * @param int $disponibilite
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
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
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param string $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getTypeorganisateur()
    {
        return $this->typeorganisateur;
    }

    /**
     * @param string $typeorganisateur
     */
    public function setTypeorganisateur($typeorganisateur)
    {
        $this->typeorganisateur = $typeorganisateur;
    }

    /**
     * @return int
     */
    public function getPtFidel()
    {
        return $this->ptFidel;
    }

    /**
     * @param int $ptFidel
     */
    public function setPtFidel($ptFidel)
    {
        $this->ptFidel = $ptFidel;
    }

    /**
     * @return string
     */
    public function getTypeagence()
    {
        return $this->typeagence;
    }

    /**
     * @param string $typeagence
     */
    public function setTypeagence($typeagence)
    {
        $this->typeagence = $typeagence;
    }



    /**
     * @param string $facebookID
     * @return User
     */
    public function setfacebookID($facebookID)
    {
        $this->facebookID = $facebookID;

        return $this;
    }

    /**
     * @return string
     */
    public function getfacebookID()
    {
        return $this->facebookID;
    }

    /**
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }




    /**************************************************************************************/


}