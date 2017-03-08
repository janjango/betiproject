<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table(name="compte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\ManyToOne(targetEntity="Beneficiaire", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $beneficiaire;
    /**
     * @ORM\OneToMany(targetEntity="Appel", mappedBy="compte", cascade={"remove"})
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
     * Set beneficiaire
     *
     * @param \AppBundle\Entity\Beneficiaire $beneficiaire
     *
     * @return Compte
     */
    public function setBeneficiaire(\AppBundle\Entity\Beneficiaire $beneficiaire = null)
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    /**
     * Get beneficiaire
     *
     * @return \AppBundle\Entity\Beneficiaire
     */
    public function getBeneficiaire()
    {
        return $this->beneficiaire;
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
}
