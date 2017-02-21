<?php

namespace Jac\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 *
 * @ORM\Entity()
 * @ORM\Table("User")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @Vich\Uploadable
 */
class User extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string The username of the user.
     *
     * @Groups({"user_read", "user_write"})
     *
     * @Assert\Length(min="6")
     */
    protected $username;

    /**
     * @var string The email of the user.
     *
     * @Groups({"user_read", "user_write"})
     */
    protected $email;

    /**
     * @var string Plain password. Used for model validation. Must not be persisted.
     *
     * @Groups({"user_write"})
     */
    protected $plainPassword;

    /**
     * @var boolean Shows that the user is enabled
     *
     * @Groups({"user_read", "user_write"})
     */
    protected $enabled;

    /**
     * @var array Array, role(s) of the user
     *
     * @Groups({"user_read", "user_write"})
     */
    protected $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstName", type="string", length=45, nullable=false)
     * @Assert\Length(min="3")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_lastName", type="string", length=45, nullable=false)
     * @Assert\Length(min="3")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $phone;

    /**
     * @var \DateTime Date of birth.
     *
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    private $birthDate;

    /**
     * @var string Gender of the person.
     *
     * @ORM\Column(nullable=true)
     * @Assert\Type(type="string")
     */
    private $gender;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Privilege", mappedBy="user")
     */
    private $privileges;


    public function __construct() {
        parent::__construct();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Add privilege
     *
     * @param \AppBundle\Entity\Privilege $privilege
     *
     * @return User
     */
    public function addPrivilege(\AppBundle\Entity\Privilege $privilege)
    {
        $this->privileges[] = $privilege;

        return $this;
    }

    /**
     * Remove privilege
     *
     * @param \AppBundle\Entity\Privilege $privilege
     */
    public function removePrivilege(\AppBundle\Entity\Privilege $privilege)
    {
        $this->privileges->removeElement($privilege);
    }

    /**
     * Get privileges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }
}
