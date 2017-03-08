<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 * @ORM\Table("service")
 * @ORM\HasLifecycleCallbacks()
 */
class Service {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string The libelle of the Service.
     * @ORM\Column(name="libelle", nullable=true)
     * @Assert\Type(type="string")
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="Direction", inversedBy="services")
     */
    private $direction;

    /**
     * @ORM\OneToMany(targetEntity="Jac\UserBundle\Entity\User", mappedBy="service")
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
     * @return Service
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
     * Set direction
     *
     * @param \AppBundle\Entity\Direction $direction
     *
     * @return Service
     */
    public function setDirection(\AppBundle\Entity\Direction $direction = null) {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return \AppBundle\Entity\Direction
     */
    public function getDirection() {
        return $this->direction;
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
     * @return Service
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
