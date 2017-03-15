<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table(name="comptebancaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComptebancaireRepository")
 */
class Comptebancaire
{
    /**
     * @ORM\OneToMany(targetEntity="Appel", mappedBy="comptebancaire", cascade={"remove"})
     */
    private $appels;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=50)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255, nullable=true)
     */
    private $intitule;
    
    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=255, nullable=true)
     */
    private $institution;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreate", type="datetime", nullable=true, nullable=true)
     */
    private $dateCreate;

    /**
     * @var string
     * @ORM\Column(name="userCreate", type="string", length=255, nullable=true)
     */
    private $userCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetime", nullable=true)
     */
    private $dateModif;

    /**
     * @var string
     *
     * @ORM\Column(name="userModif", type="string", length=255, nullable=true)
     */
    private $userModif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedelete", type="datetime", nullable=true)
     */
    private $datedelete;

    /**
     * @var string
     *
     * @ORM\Column(name="$userdelete", type="string", length=255, nullable=true)
     */
    private $userdelete;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Compte
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Compte
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appels = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add appel
     *
     * @param \AppBundle\Entity\Appel $appel
     *
     * @return Compte
     */
    public function addAppel(\AppBundle\Entity\Appel $appel)
    {
        $this->appels[] = $appel;

        return $this;
    }

    /**
     * Remove appel
     *
     * @param \AppBundle\Entity\Appel $appel
     */
    public function removeAppel(\AppBundle\Entity\Appel $appel)
    {
        $this->appels->removeElement($appel);
    }

    /**
     * Get appels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppels()
    {
        return $this->appels;
    }

    /**
     * Set institution
     *
     * @param string $institution
     *
     * @return Compte
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return string
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Compte
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set userCreate
     *
     * @param string $userCreate
     *
     * @return Compte
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return string
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Compte
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set userModif
     *
     * @param string $userModif
     *
     * @return Compte
     */
    public function setUserModif($userModif)
    {
        $this->userModif = $userModif;

        return $this;
    }

    /**
     * Get userModif
     *
     * @return string
     */
    public function getUserModif()
    {
        return $this->userModif;
    }

    /**
     * Set datedelete
     *
     * @param \DateTime $datedelete
     *
     * @return Compte
     */
    public function setDatedelete($datedelete)
    {
        $this->datedelete = $datedelete;

        return $this;
    }

    /**
     * Get datedelete
     *
     * @return \DateTime
     */
    public function getDatedelete()
    {
        return $this->datedelete;
    }

    /**
     * Set userdelete
     *
     * @param string $userdelete
     *
     * @return Compte
     */
    public function setUserdelete($userdelete)
    {
        $this->userdelete = $userdelete;

        return $this;
    }

    /**
     * Get userdelete
     *
     * @return string
     */
    public function getUserdelete()
    {
        return $this->userdelete;
    }

    public function __toString() {
        return 'N° ' . $this->getNumero() . ', Intitulé : ' . $this->getIntitule(). ', Instituion : ' . $this->getInstitution();
    }
}
