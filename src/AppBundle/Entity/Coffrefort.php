<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Coffrefort
 *
 * @ORM\Table(name="coffrefort")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoffrefortRepository")
 * @UniqueEntity("refCheque",
 *  message="Cette référence existe déjà.")
 */
class Coffrefort {
    /**
     * @ORM\ManyToOne(targetEntity="Exercice", inversedBy="coffreforts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $exercice;
    
    /**
     * @ORM\ManyToOne(targetEntity="Encaissement", inversedBy="coffreforts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $encaissement;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEmission", type="datetime", nullable=true, nullable=true)
     */
    private $dateEmission;

    /**
     * @var string
     * @ORM\Column(name="refCheque", type="string", length=255, nullable=true)
     */
    private $refCheque;

    /**
     * @var string
     *
     * @ORM\Column(name="libOperation", type="string", length=255, nullable=true)
     */
    private $libOperation;

    /**
     * @var decimal
     *
     * @ORM\Column(name="montantRetire", type="decimal", precision=10, scale=2)
     */
    private $montantRetire;

    /**
     * @ORM\ManyToOne(targetEntity="Beneficiaire")
     * @ORM\JoinColumn(nullable=true)
     */
    private $beneficiaire;
    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="text", nullable=true)
     */
    private $observation;

    /**
     * @var string; Encaissement ou Autre
     *
     * @ORM\Column(name="source_alimaentation", type="string", length=255, nullable=true)
     */
    private $sourceAlimaentation;

    /**
     * @var string; Si autre on ajoute ce champ
     *
     * @ORM\Column(name="autre_alimaentation", type="string", length=255, nullable=true)
     */
    private $autreAlimaentation;

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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dateEmission
     *
     * @param \DateTime $dateEmission
     *
     * @return Coffrefort
     */
    public function setDateEmission($dateEmission) {
        $this->dateEmission = $dateEmission;

        return $this;
    }

    /**
     * Get dateEmission
     *
     * @return \DateTime
     */
    public function getDateEmission() {
        return $this->dateEmission;
    }

    /**
     * Set refCheque
     *
     * @param string $refCheque
     *
     * @return Coffrefort
     */
    public function setRefCheque($refCheque) {
        $this->refCheque = $refCheque;

        return $this;
    }

    /**
     * Get refCheque
     *
     * @return string
     */
    public function getRefCheque() {
        return $this->refCheque;
    }

    /**
     * Set libOperation
     *
     * @param string $libOperation
     *
     * @return Coffrefort
     */
    public function setLibOperation($libOperation) {
        $this->libOperation = $libOperation;

        return $this;
    }

    /**
     * Get libOperation
     *
     * @return string
     */
    public function getLibOperation() {
        return $this->libOperation;
    }

    /**
     * Set montantRetire
     *
     * @param string $montantRetire
     *
     * @return Coffrefort
     */
    public function setMontantRetire($montantRetire) {
        $this->montantRetire = $montantRetire;

        return $this;
    }

    /**
     * Get montantRetire
     *
     * @return string
     */
    public function getMontantRetire() {
        return $this->montantRetire;
    }

    /**
     * Set beneficiaire
     *
     * @param string $beneficiaire
     *
     * @return Coffrefort
     */
    public function setBeneficiaire($beneficiaire) {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    /**
     * Get beneficiaire
     *
     * @return string
     */
    public function getBeneficiaire() {
        return $this->beneficiaire;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Coffrefort
     */
    public function setObservation($observation) {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation() {
        return $this->observation;
    }

    /**
     * Set encaissement
     *
     * @param \AppBundle\Entity\Encaissement $encaissement
     *
     * @return Coffrefort
     */
    public function setEncaissement(\AppBundle\Entity\Encaissement $encaissement = null) {
        $this->encaissement = $encaissement;

        return $this;
    }

    /**
     * Get encaissement
     *
     * @return \AppBundle\Entity\Encaissement
     */
    public function getEncaissement() {
        return $this->encaissement;
    }

    /**
     * Set sourceAlimaentation
     *
     * @param string $sourceAlimaentation
     *
     * @return Coffrefort
     */
    public function setSourceAlimaentation($sourceAlimaentation) {
        $this->sourceAlimaentation = $sourceAlimaentation;

        return $this;
    }

    /**
     * Get sourceAlimaentation
     *
     * @return string
     */
    public function getSourceAlimaentation() {
        return $this->sourceAlimaentation;
    }

    /**
     * Set autreAlimaentation
     *
     * @param string $autreAlimaentation
     *
     * @return Coffrefort
     */
    public function setAutreAlimaentation($autreAlimaentation) {
        $this->autreAlimaentation = $autreAlimaentation;

        return $this;
    }

    /**
     * Get autreAlimaentation
     *
     * @return string
     */
    public function getAutreAlimaentation() {
        return $this->autreAlimaentation;
    }


    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Coffrefort
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
     * @return Coffrefort
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
     * @return Coffrefort
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
     * @return Coffrefort
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
     * Set exercice
     *
     * @param \AppBundle\Entity\Exercice $exercice
     *
     * @return Coffrefort
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
}
