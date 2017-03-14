<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Encaissement
 *
 * @ORM\Table(name="encaissement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EncaissementRepository")
 */
class Encaissement
{
    /**
     * @ORM\OneToMany(targetEntity="Paiement", mappedBy="encaissement", cascade={"remove"})
     */
    private $paiements;
    /**
     * @ORM\ManyToOne(targetEntity="Exercice", inversedBy="encaissements")
     * @ORM\JoinColumn(nullable=true)
     */
    private $exercice;
    /**
     * @ORM\ManyToOne(targetEntity="Appel", inversedBy="encaissements")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $appel;
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
     * @ORM\Column(name="montantEncaisse", type="decimal", precision=10, scale=2)
     */
    private $montantEncaisse;
    /**
     * @var string
     *
     * @ORM\Column(name="numeroCompte", type="string", length=255)
     */
    private $numeroCompte;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEncaissement", type="datetime", nullable=true, nullable=true)
     */
    private $dateEncaissement;
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
     * @var string
     * @ORM\Column(name="solde", type="decimal", precision=10, scale=2, nullable=true)
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
     * Set montantEncaisse
     *
     * @param string $montantEncaisse
     *
     * @return Encaissement
     */
    public function setMontantEncaisse($montantEncaisse)
    {
        $this->montantEncaisse = $montantEncaisse;
        return $this;
    }
    /**
     * Get montantEncaisse
     *
     * @return string
     */
    public function getMontantEncaisse()
    {
        return $this->montantEncaisse;
    }
    /**
     * Set numeroCompte
     *
     * @param string $numeroCompte
     *
     * @return Encaissement
     */
    public function setNumeroCompte($numeroCompte)
    {
        $this->numeroCompte = $numeroCompte;
        return $this;
    }
    /**
     * Get numeroCompte
     *
     * @return string
     */
    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }
    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Encaissement
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
     * @return Encaissement
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
     * @return Encaissement
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
     * @return Encaissement
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
     * Set appel
     *
     * @param \AppBundle\Entity\Appel $appel
     *
     * @return Encaissement
     */
    public function setAppel(\AppBundle\Entity\Appel $appel = null)
    {
        $this->appel = $appel;
        return $this;
    }
    /**
     * Get appel
     *
     * @return \AppBundle\Entity\Appel
     */
    public function getAppel()
    {
        return $this->appel;
    }
    /**
     * Set dateEncaissement
     *
     * @param \DateTime $dateEncaissement
     *
     * @return Encaissement
     */
    public function setDateEncaissement($dateEncaissement)
    {
        $this->dateEncaissement = $dateEncaissement;
        return $this;
    }
    /**
     * Get dateEncaissement
     *
     * @return \DateTime
     */
    public function getDateEncaissement()
    {
        return $this->dateEncaissement;
    }
    /**
     * Set exercice
     *
     * @param \AppBundle\Entity\Exercice $exercice
     *
     * @return Encaissement
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
     * Constructor
     */
    public function __construct()
    {
        $this->paiements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add paiement
     *
     * @param \AppBundle\Entity\Paiement $paiement
     *
     * @return Encaissement
     */
    public function addPaiement(\AppBundle\Entity\Paiement $paiement)
    {
        $this->paiements[] = $paiement;
        return $this;
    }
    /**
     * Remove paiement
     *
     * @param \AppBundle\Entity\Paiement $paiement
     */
    public function removePaiement(\AppBundle\Entity\Paiement $paiement)
    {
        $this->paiements->removeElement($paiement);
    }
    /**
     * Get paiements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPaiements()
    {
        return $this->paiements;
    }
    public function getMontantpaye()
    {
        $i=0;
        foreach ($this->getPaiements() as $j){
            $i += $j->getMontantTtc();
        }
        return $i;
    }
    public function __toString() {
        return 'Encaissement N° ' . $this->getId() . ', Solde: ' . $this->getSolde();
    }

    /**
     * Set solde
     *
     * @param string $solde
     *
     * @return Encaissement
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
}
