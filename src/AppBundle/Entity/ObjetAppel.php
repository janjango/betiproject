<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjetAppel
 *
 * @ORM\Table(name="objet_appel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObjetAppelRepository")
 */
class ObjetAppel
{
    /**
     * @ORM\OneToMany(targetEntity="Appel", mappedBy="objetappel")
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
     * @ORM\Column(name="libObjet", type="string", length=255)
     */
    private $libObjet;


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
     * Set libObjet
     *
     * @param string $libObjet
     *
     * @return ObjetAppel
     */
    public function setLibObjet($libObjet)
    {
        $this->libObjet = $libObjet;

        return $this;
    }

    /**
     * Get libObjet
     *
     * @return string
     */
    public function getLibObjet()
    {
        return $this->libObjet;
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
     * @return ObjetAppel
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
