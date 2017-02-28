<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrivilegeRepository")
 * @ORM\Table("Privilege")
 * @ORM\HasLifecycleCallbacks()
 */
class Privilege {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="SousMenu", inversedBy="privileges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sousMenu;

    /**
     * @ORM\ManyToOne(targetEntity="Jac\UserBundle\Entity\User", inversedBy="privileges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * Set sousMenu
     *
     * @param \AppBundle\Entity\SousMenu $sousMenu
     *
     * @return Privilege
     */
    public function setSousMenu(\AppBundle\Entity\SousMenu $sousMenu)
    {
        $this->sousMenu = $sousMenu;

        return $this;
    }

    /**
     * Get sousMenu
     *
     * @return \AppBundle\Entity\SousMenu
     */
    public function getSousMenu()
    {
        return $this->sousMenu;
    }

    /**
     * Set user
     *
     * @param \Jac\UserBundle\Entity\User $user
     *
     * @return Privilege
     */
    public function setUser(\Jac\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Jac\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function __toString(){
        return $this->getSousMenu() ." ". $this->getUser();
    }
}
