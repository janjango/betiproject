<?php

namespace Jac\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="Jac\UserBundle\Entity\StatutRepository")
 * @ORM\Table("statut")
 * @ORM\HasLifecycleCallbacks()
 */
class Statut {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string The libelle of the Statut.
     * @ORM\Column(name="libelle", nullable=true)
     * @Assert\Type(type="string")
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="Jac\UserBundle\Entity\User", mappedBy="statut")
     */
    private $users;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Statut
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Jac\UserBundle\Entity\User $user
     *
     * @return Statut
     */
    public function addUser(\Jac\UserBundle\Entity\User $user) {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Jac\UserBundle\Entity\User $user
     */
    public function removeUser(\Jac\UserBundle\Entity\User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers() {
        return $this->users;
    }

    public function __toString() {
        return $this->getLibelle();
    }

}
