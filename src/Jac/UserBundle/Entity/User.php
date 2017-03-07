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
 * @ORM\Entity(repositoryClass="Jac\UserBundle\Entity\UserRepository")
 * @ORM\Table("user")
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

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Service", inversedBy="users")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="Statut", inversedBy="users")
     */
    private $statut;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssignationBeneficiaire", mappedBy="user")
     */
    private $assignations;

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
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate() {
        return $this->birthDate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender) {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Add privilege
     *
     * @param \AppBundle\Entity\Privilege $privilege
     *
     * @return User
     */
    public function addPrivilege(\AppBundle\Entity\Privilege $privilege) {
        $this->privileges[] = $privilege;

        return $this;
    }

    /**
     * Remove privilege
     *
     * @param \AppBundle\Entity\Privilege $privilege
     */
    public function removePrivilege(\AppBundle\Entity\Privilege $privilege) {
        $this->privileges->removeElement($privilege);
    }

    /**
     * Get privileges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrivileges() {
        return $this->privileges;
    }

    /**
     * Set service
     *
     * @param \AppBundle\Entity\Service $service
     *
     * @return User
     */
    public function setService(\AppBundle\Entity\Service $service = null) {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \AppBundle\Entity\Service
     */
    public function getService() {
        return $this->service;
    }

    /**
     * Set statut
     *
     * @param \Jac\UserBundle\Entity\Statut $statut
     *
     * @return User
     */
    public function setStatut(\Jac\UserBundle\Entity\Statut $statut = null) {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \Jac\UserBundle\Entity\Statut
     */
    public function getStatut() {
        return $this->statut;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return User
     */
    public function setImageFile(File $image = null) {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return User
     */
    public function setImageName($imageName) {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName() {
        return $this->imageName;
    }

    /**
     * Add assignation
     *
     * @param \AppBundle\Entity\AssignationBeneficiaire $assignation
     *
     * @return User
     */
    public function addAssignation(\AppBundle\Entity\AssignationBeneficiaire $assignation) {
        $this->assignations[] = $assignation;

        return $this;
    }

    /**
     * Remove assignation
     *
     * @param \AppBundle\Entity\AssignationBeneficiaire $assignation
     */
    public function removeAssignation(\AppBundle\Entity\AssignationBeneficiaire $assignation) {
        $this->assignations->removeElement($assignation);
    }

    /**
     * Get assignations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssignations() {
        return $this->assignations;
    }

}
