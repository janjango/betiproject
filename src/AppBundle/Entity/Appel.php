<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Tests\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Appel
 *
 * @ORM\Table(name="appel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppelRepository")
 * @UniqueEntity("referenceAppel",
 *  message="Cette référence existe déjà.")
 */
class Appel
{
    /**
     * @ORM\OneToMany(targetEntity="Encaissement", mappedBy="appel", cascade={"remove"})
     */
    private $encaissements;
    /**
     * @ORM\ManyToOne(targetEntity="Exercice", inversedBy="appels")
     * @ORM\JoinColumn(nullable=true)
     */
    private $exercice;
    /**
     * @ORM\ManyToOne(targetEntity="Compte", inversedBy="appels")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $compte;
    /**
     * @ORM\ManyToOne(targetEntity="Comptebancaire", inversedBy="appels")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $comptebancaire;
    /**
     * @ORM\ManyToOne(targetEntity="Beneficiaire", inversedBy="appels")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
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
     * @var string
     *
     * @ORM\Column(name="referenceAppelfond", type="string", length=255, nullable=true)
     */
    private $referenceAppelfond;

    /**
     * @var string; Appel de fonds sur budget national ou Appel de fonds sur autre budget
     *
     * @ORM\Column(name="sourceAlimaentation", type="string", length=100, nullable=true)
     */
    private $sourceAlimaentation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAppel", type="datetime")
     */
    private $dateAppel;

    /**
     * @var text
     *
     * @ORM\Column(name="observation", type="text", nullable=true)
     */
    private $observation;

    /**
     * @var text
     *
     * @ORM\Column(name="objetappel", type="text")
     */
    private $objetappel;

    /**
     * @var string
     *
     * @ORM\Column(name="refEngagement", type="string", length=255, nullable=true)
     */
    private $refEngagement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEngagement", type="datetime", nullable=true)
     */
    private $dateEngagement;

    /**
     * @var string
     *
     * @ORM\Column(name="refBordereau", type="string", length=255, nullable=true)
     */
    private $refBordereau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBordereau", type="datetime", nullable=true)
     */
    private $dateBordereau;

    /**
     * @var string
     *
     * @ORM\Column(name="montantHt", type="decimal", precision=10, scale=2, nullable=true)
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
     * @var bool
     *
     * @ORM\Column(name="estAnnuler", type="boolean", nullable=true)
     */
    private $estAnnuler;

    /**
     * @var string
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montant;

    /**
     * @var string
     * @ORM\Column(name="solde", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $solde;

    /**
     * @var bool
     *
     * @ORM\Column(name="estEncaisser", type="boolean", nullable=true)
     */
    private $estEncaisser;

    /**
     * @var bool
     *
     * @ORM\Column(name="estSolder", type="boolean", nullable=true)
     */
    private $estSolder;

    /**
     * @var bool
     *
     * @ORM\Column(name="estParentannuler", type="boolean", nullable=true)
     */
    private $estParentannuler;

    /**
     * @var string
     *
     * @ORM\Column(name="numcomptetresor", type="string", length=155, nullable=true)
     */
    private $numcomptetresor;

    /**
     * @var string
     *
     * @ORM\Column(name="intitulecomptetresor", type="string", length=255, nullable=true)
     */
    private $intitulecomptetresor;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->encaissements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add encaissement
     *
     * @param \AppBundle\Entity\Encaissement $encaissement
     *
     * @return Appel
     */
    public function addEncaissement(\AppBundle\Entity\Encaissement $encaissement)
    {
        $this->encaissements[] = $encaissement;

        return $this;
    }

    /**
     * Remove encaissement
     *
     * @param \AppBundle\Entity\Encaissement $encaissement
     */
    public function removeEncaissement(\AppBundle\Entity\Encaissement $encaissement)
    {
        $this->encaissements->removeElement($encaissement);
    }

    /**
     * Get encaissements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEncaissements()
    {
        return $this->encaissements;
    }

    /**
     * Set estEncaisser
     *
     * @param boolean $estEncaisser
     *
     * @return Appel
     */
    public function setEstEncaisser($estEncaisser)
    {
        $this->estEncaisser = $estEncaisser;

        return $this;
    }

    /**
     * Get estEncaisser
     *
     * @return boolean
     */
    public function getEstEncaisser()
    {
        return $this->estEncaisser;
    }

    /**
     * Set estParentannuler
     *
     * @param boolean $estParentannuler
     *
     * @return Appel
     */
    public function setEstParentannuler($estParentannuler)
    {
        $this->estParentannuler = $estParentannuler;

        return $this;
    }

    /**
     * Get estParentannuler
     *
     * @return boolean
     */
    public function getEstParentannuler()
    {
        return $this->estParentannuler;
    }


    public function __toString() {
        return $this->referenceAppel;
    }

    public function getMontantEncaissement(){
        $i=0;
        foreach ($this->getEncaissements() as $unencaissement){
            $i += $unencaissement->getMontantEncaisse();
        }
        return $i;
    }

    /**
     * Set objetappel
     *
     * @param string $objetappel
     *
     * @return Appel
     */
    public function setObjetappel($objetappel)
    {
        $this->objetappel = $objetappel;

        return $this;
    }

    /**
     * Get objetappel
     *
     * @return string
     */
    public function getObjetappel()
    {
        return $this->objetappel;
    }

    /**
     * Set numcomptetresor
     *
     * @param string $numcomptetresor
     *
     * @return Appel
     */
    public function setNumcomptetresor($numcomptetresor)
    {
        $this->numcomptetresor = $numcomptetresor;

        return $this;
    }

    /**
     * Get numcomptetresor
     *
     * @return string
     */
    public function getNumcomptetresor()
    {
        return $this->numcomptetresor;
    }

    /**
     * Set intitulecomptetresor
     *
     * @param string $intitulecomptetresor
     *
     * @return Appel
     */
    public function setIntitulecomptetresor($intitulecomptetresor)
    {
        $this->intitulecomptetresor = $intitulecomptetresor;

        return $this;
    }

    /**
     * Get intitulecomptetresor
     *
     * @return string
     */
    public function getIntitulecomptetresor()
    {
        return $this->intitulecomptetresor;
    }

    /**
     * Set compte
     *
     * @param \AppBundle\Entity\Compte $compte
     *
     * @return Appel
     */
    public function setCompte(\AppBundle\Entity\Compte $compte = null)
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return \AppBundle\Entity\Compte
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * Set estSolder
     *
     * @param boolean $estSolder
     *
     * @return Appel
     */
    public function setEstSolder($estSolder)
    {
        $this->estSolder = $estSolder;

        return $this;
    }

    /**
     * Get estSolder
     *
     * @return boolean
     */
    public function getEstSolder()
    {
        return $this->estSolder;
    }

    /**
     * Set datedelete
     *
     * @param \DateTime $datedelete
     *
     * @return Appel
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
     * @return Appel
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

    /**
     * Set referenceAppelfond
     *
     * @param string $referenceAppelfond
     *
     * @return Appel
     */
    public function setReferenceAppelfond($referenceAppelfond)
    {
        $this->referenceAppelfond = $referenceAppelfond;

        return $this;
    }

    /**
     * Get referenceAppelfond
     *
     * @return string
     */
    public function getReferenceAppelfond()
    {
        return $this->referenceAppelfond;
    }

    /**
     * Set comptebancaire
     *
     * @param \AppBundle\Entity\Comptebancaire $comptebancaire
     *
     * @return Appel
     */
    public function setComptebancaire(\AppBundle\Entity\Comptebancaire $comptebancaire = null)
    {
        $this->comptebancaire = $comptebancaire;

        return $this;
    }

    /**
     * Get comptebancaire
     *
     * @return \AppBundle\Entity\Comptebancaire
     */
    public function getComptebancaire()
    {
        return $this->comptebancaire;
    }

    /**
     * Set sourceAlimaentation
     *
     * @param string $sourceAlimaentation
     *
     * @return Appel
     */
    public function setSourceAlimaentation($sourceAlimaentation)
    {
        $this->sourceAlimaentation = $sourceAlimaentation;

        return $this;
    }

    /**
     * Get sourceAlimaentation
     *
     * @return string
     */
    public function getSourceAlimaentation()
    {
        return $this->sourceAlimaentation;
    }
}
