<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssignationBeneficiaireRepository")
 * @ORM\Table("assignationbeneficiaire")
 * @ORM\HasLifecycleCallbacks()
 */
class AssignationBeneficiaire {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Beneficiaire", inversedBy="assignations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beneficiaire;

    /**
     * @ORM\ManyToOne(targetEntity="Jac\UserBundle\Entity\User", inversedBy="assignations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set beneficiaire
     *
     * @param \AppBundle\Entity\Beneficiaire $beneficiaire
     *
     * @return AssignationBeneficiaire
     */
    public function setBeneficiaire(\AppBundle\Entity\Beneficiaire $beneficiaire) {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    /**
     * Get beneficiaire
     *
     * @return \AppBundle\Entity\Beneficiaire
     */
    public function getBeneficiaire() {
        return $this->beneficiaire;
    }

    /**
     * Set user
     *
     * @param \Jac\UserBundle\Entity\User $user
     *
     * @return AssignationBeneficiaire
     */
    public function setUser(\Jac\UserBundle\Entity\User $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Jac\UserBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    public function __toString() {
        return $this->getBeneficiaire() . " " . $this->getUser();
    }

}
