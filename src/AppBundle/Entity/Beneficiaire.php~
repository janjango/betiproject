<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beneficiaire
 *
 * @ORM\Table(name="beneficiaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BeneficiaireRepository")
 */
class Beneficiaire
{
    /**
     * @ORM\OneToMany(targetEntity="Appel", mappedBy="beneficiaire")
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
     * @ORM\Column(name="libBeneficiaire", type="string", length=255)
     */
    private $libBeneficiaire;
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=25)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroCompte", type="integer")
     */
    private $numeroCompte;

    /**
     * @var string
     *
     * @ORM\Column(name="intituleCompte", type="string", length=255)
     */
    private $intituleCompte;


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
     * Set libBeneficiaire
     *
     * @param string $libBeneficiaire
     *
     * @return Beneficiaire
     */
    public function setLibBeneficiaire($libBeneficiaire)
    {
        $this->libBeneficiaire = $libBeneficiaire;

        return $this;
    }

    /**
     * Get libBeneficiaire
     *
     * @return string
     */
    public function getLibBeneficiaire()
    {
        return $this->libBeneficiaire;
    }

    /**
     * Set numeroCompte
     *
     * @param integer $numeroCompte
     *
     * @return Beneficiaire
     */
    public function setNumeroCompte($numeroCompte)
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    /**
     * Get numeroCompte
     *
     * @return int
     */
    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }

    /**
     * Set intituleCompte
     *
     * @param string $intituleCompte
     *
     * @return Beneficiaire
     */
    public function setIntituleCompte($intituleCompte)
    {
        $this->intituleCompte = $intituleCompte;

        return $this;
    }

    /**
     * Get intituleCompte
     *
     * @return string
     */
    public function getIntituleCompte()
    {
        return $this->intituleCompte;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Beneficiaire
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * @return Beneficiaire
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
    public function __toString() {
        return $this->libBeneficiaire;
    }

}
