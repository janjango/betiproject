<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coffrefort
 *
 * @ORM\Table(name="Coffrefort")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoffrefortRepository")
 */
class Coffrefort {

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
     * @var string
     *
     * @ORM\Column(name="beneficiaire", type="string", length=255, nullable=true)
     */
    private $beneficiaire;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="text", nullable=true)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="sourceAlimaentation", type="string", length=255, nullable=true)
     */
    private $sourceAlimaentation;
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateEmission
     *
     * @param \DateTime $dateEmission
     *
     * @return Coffrefort
     */
    public function setDateEmission($dateEmission)
    {
        $this->dateEmission = $dateEmission;

        return $this;
    }

    /**
     * Get dateEmission
     *
     * @return \DateTime
     */
    public function getDateEmission()
    {
        return $this->dateEmission;
    }

    /**
     * Set refCheque
     *
     * @param string $refCheque
     *
     * @return Coffrefort
     */
    public function setRefCheque($refCheque)
    {
        $this->refCheque = $refCheque;

        return $this;
    }

    /**
     * Get refCheque
     *
     * @return string
     */
    public function getRefCheque()
    {
        return $this->refCheque;
    }

    /**
     * Set libOperation
     *
     * @param string $libOperation
     *
     * @return Coffrefort
     */
    public function setLibOperation($libOperation)
    {
        $this->libOperation = $libOperation;

        return $this;
    }

    /**
     * Get libOperation
     *
     * @return string
     */
    public function getLibOperation()
    {
        return $this->libOperation;
    }

    /**
     * Set montantRetire
     *
     * @param string $montantRetire
     *
     * @return Coffrefort
     */
    public function setMontantRetire($montantRetire)
    {
        $this->montantRetire = $montantRetire;

        return $this;
    }

    /**
     * Get montantRetire
     *
     * @return string
     */
    public function getMontantRetire()
    {
        return $this->montantRetire;
    }

    /**
     * Set beneficiaire
     *
     * @param string $beneficiaire
     *
     * @return Coffrefort
     */
    public function setBeneficiaire($beneficiaire)
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    /**
     * Get beneficiaire
     *
     * @return string
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
     * @return Coffrefort
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
     * Set encaissement
     *
     * @param \AppBundle\Entity\Encaissement $encaissement
     *
     * @return Coffrefort
     */
    public function setEncaissement(\AppBundle\Entity\Encaissement $encaissement = null)
    {
        $this->encaissement = $encaissement;

        return $this;
    }

    /**
     * Get encaissement
     *
     * @return \AppBundle\Entity\Encaissement
     */
    public function getEncaissement()
    {
        return $this->encaissement;
    }

    /**
     * Set sourceAlimaentation
     *
     * @param string $sourceAlimaentation
     *
     * @return Coffrefort
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
