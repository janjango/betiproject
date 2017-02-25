<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appel
 *
 * @ORM\Table(name="appel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppelRepository")
 */
class Appel
{
    /**
     * @ORM\ManyToOne(targetEntity="ObjetAppel", inversedBy="appels")
<<<<<<< HEAD
     * @ORM\JoinColumn(nullable=true)
=======
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $objetappel;
    /**
     * @ORM\ManyToOne(targetEntity="Exercice", inversedBy="appels")
<<<<<<< HEAD
     * @ORM\JoinColumn(nullable=true)
=======
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $exercice;
    /**
     * @ORM\ManyToOne(targetEntity="Beneficiaire", inversedBy="appels")
<<<<<<< HEAD
     * @ORM\JoinColumn(nullable=true)
=======
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $beneficiaire;
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
     * @ORM\Column(name="referenceAppel", type="string", length=255)
     */
    private $referenceAppel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAppel", type="datetime")
     */
    private $dateAppel;

    /**
     * @var text
     *
     * @ORM\Column(name="observation", type="text")
     */
    private $observation;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="refEngagement", type="string", length=255, nullable=true)
=======
     * @ORM\Column(name="refEngagement", type="string", length=255)
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $refEngagement;

    /**
     * @var \DateTime
     *
<<<<<<< HEAD
     * @ORM\Column(name="dateEngagement", type="datetime", nullable=true)
=======
     * @ORM\Column(name="dateEngagement", type="datetime")
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $dateEngagement;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="refBordereau", type="string", length=255, nullable=true)
=======
     * @ORM\Column(name="refBordereau", type="string", length=255)
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $refBordereau;

    /**
     * @var \DateTime
     *
<<<<<<< HEAD
     * @ORM\Column(name="dateBordereau", type="datetime", nullable=true)
=======
     * @ORM\Column(name="dateBordereau", type="datetime")
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $dateBordereau;

    /**
     * @var string
     *
     * @ORM\Column(name="montantHt", type="decimal", precision=10, scale=2)
     */
    private $montantHt;

    /**
     * @var string
     *
     * @ORM\Column(name="montantTtc", type="decimal", precision=10, scale=2)
     */
    private $montantTtc;

    /**
     * @var \DateTime
     *
<<<<<<< HEAD
     * @ORM\Column(name="dateCreate", type="datetime", nullable=true, nullable=true)
=======
     * @ORM\Column(name="dateCreate", type="datetime")
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $dateCreate;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="userCreate", type="string", length=255, nullable=true)
=======
     * @ORM\Column(name="userCreate", type="string", length=255)
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $userCreate;

    /**
     * @var \DateTime
     *
<<<<<<< HEAD
     * @ORM\Column(name="dateModif", type="datetime", nullable=true)
=======
     * @ORM\Column(name="dateModif", type="datetime")
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $dateModif;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="userModif", type="string", length=255, nullable=true)
=======
     * @ORM\Column(name="userModif", type="string", length=255)
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $userModif;

    /**
     * @var bool
     *
<<<<<<< HEAD
     * @ORM\Column(name="estAnnuler", type="boolean", nullable=true)
=======
     * @ORM\Column(name="estAnnuler", type="boolean")
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $estAnnuler;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=2, nullable=true)
=======
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=2)
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $montant;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="solde", type="decimal", precision=10, scale=2, nullable=true)
=======
     * @ORM\Column(name="solde", type="decimal", precision=10, scale=2)
>>>>>>> e90a8e86fcf344935894ebd685ca3527a71d55c4
     */
    private $solde;


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
     * Set referenceAppel
     *
     * @param string $referenceAppel
     *
     * @return Appel
     */
    public function setReferenceAppel($referenceAppel)
    {
        $this->referenceAppel = $referenceAppel;

        return $this;
    }

    /**
     * Get referenceAppel
     *
     * @return string
     */
    public function getReferenceAppel()
    {
        return $this->referenceAppel;
    }

    /**
     * Set dateAppel
     *
     * @param \DateTime $dateAppel
     *
     * @return Appel
     */
    public function setDateAppel($dateAppel)
    {
        $this->dateAppel = $dateAppel;

        return $this;
    }

    /**
     * Get dateAppel
     *
     * @return \DateTime
     */
    public function getDateAppel()
    {
        return $this->dateAppel;
    }

    /**
     * Set refEngagement
     *
     * @param string $refEngagement
     *
     * @return Appel
     */
    public function setRefEngagement($refEngagement)
    {
        $this->refEngagement = $refEngagement;

        return $this;
    }

    /**
     * Get refEngagement
     *
     * @return string
     */
    public function getRefEngagement()
    {
        return $this->refEngagement;
    }

    /**
     * Set dateEngagement
     *
     * @param \DateTime $dateEngagement
     *
     * @return Appel
     */
    public function setDateEngagement($dateEngagement)
    {
        $this->dateEngagement = $dateEngagement;

        return $this;
    }

    /**
     * Get dateEngagement
     *
     * @return \DateTime
     */
    public function getDateEngagement()
    {
        return $this->dateEngagement;
    }

    /**
     * Set refBordereau
     *
     * @param string $refBordereau
     *
     * @return Appel
     */
    public function setRefBordereau($refBordereau)
    {
        $this->refBordereau = $refBordereau;

        return $this;
    }

    /**
     * Get refBordereau
     *
     * @return string
     */
    public function getRefBordereau()
    {
        return $this->refBordereau;
    }

    /**
     * Set dateBordereau
     *
     * @param \DateTime $dateBordereau
     *
     * @return Appel
     */
    public function setDateBordereau($dateBordereau)
    {
        $this->dateBordereau = $dateBordereau;

        return $this;
    }

    /**
     * Get dateBordereau
     *
     * @return \DateTime
     */
    public function getDateBordereau()
    {
        return $this->dateBordereau;
    }

    /**
     * Set montantHt
     *
     * @param string $montantHt
     *
     * @return Appel
     */
    public function setMontantHt($montantHt)
    {
        $this->montantHt = $montantHt;

        return $this;
    }

    /**
     * Get montantHt
     *
     * @return string
     */
    public function getMontantHt()
    {
        return $this->montantHt;
    }

    /**
     * Set montantTtc
     *
     * @param string $montantTtc
     *
     * @return Appel
     */
    public function setMontantTtc($montantTtc)
    {
        $this->montantTtc = $montantTtc;

        return $this;
    }

    /**
     * Get montantTtc
     *
     * @return string
     */
    public function getMontantTtc()
    {
        return $this->montantTtc;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Appel
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
     * @return Appel
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
     * @return Appel
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
     * @return Appel
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
     * Set estAnnuler
     *
     * @param boolean $estAnnuler
     *
     * @return Appel
     */
    public function setEstAnnuler($estAnnuler)
    {
        $this->estAnnuler = $estAnnuler;

        return $this;
    }

    /**
     * Get estAnnuler
     *
     * @return bool
     */
    public function getEstAnnuler()
    {
        return $this->estAnnuler;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return Appel
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set solde
     *
     * @param string $solde
     *
     * @return Appel
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get solde
     *
     * @return string
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set objetappel
     *
     * @param \AppBundle\Entity\ObjetAppel $objetappel
     *
     * @return Appel
     */
    public function setObjetappel(\AppBundle\Entity\ObjetAppel $objetappel = null)
    {
        $this->objetappel = $objetappel;

        return $this;
    }

    /**
     * Get objetappel
     *
     * @return \AppBundle\Entity\ObjetAppel
     */
    public function getObjetappel()
    {
        return $this->objetappel;
    }

    /**
     * Set exercice
     *
     * @param \AppBundle\Entity\Exercice $exercice
     *
     * @return Appel
     */
    public function setExercice(\AppBundle\Entity\Exercice $exercice = null)
    {
        $this->exercice = $exercice;

        return $this;
    }

    /**
     * Get exercice
     *
     * @return \AppBundle\Entity\Exercice
     */
    public function getExercice()
    {
        return $this->exercice;
    }



    /**
     * Set beneficiaire
     *
     * @param \AppBundle\Entity\Beneficiaire $beneficiaire
     *
     * @return Appel
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
     * Set observation
     *
     * @param string $observation
     *
     * @return Appel
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }
}