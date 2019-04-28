<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScapeUserRepository")
 * @UniqueEntity(fields="userEmail", message="This E-mail is already used")\
 * @UniqueEntity(fields="username", message="This username is already taken")
 */
class ScapeUser implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(min=3,max=30)
     */
    private $userFirstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(min=3,max=30)
     */
    private $userLastName;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $userEmail;

    /**
     * @ORM\Column(type="string", length=12)
     * @Assert\NotBlank
     * @Assert\Length(min=10,max=10)
     */
    private $userContact;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank
     * @Assert\Length(min=5,max=30)
     */
    private $username;


    /**
     * @Assert\NotBlank
     * @Assert\Length(min=5,max=15)
     */
    private $plainPassword;

    /**
     * @Assert\IsTrue(message="The password cannot match your first name")
     */
    public function isPasswordSafe(){
       return $this->username !== $this->plainPassword;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;
    /**
     * @var array
     * @ORM\Column(type="simple_array")
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ScapeUserAddress", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type(type="App\Entity\ScapeUserAddress")
     * @Assert\Valid
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $verified;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ScapeProperties", mappedBy="scapeUser")
     */
    private $properties;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $profilePicPath;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="scapeUser", orphanRemoval=true)
     */
    private $appointment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="sacpeVendor", orphanRemoval=true)
     */
    private $vendorAppointment;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->appointment = new ArrayCollection();
        $this->vendorAppointment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserFirstName(): ?string
    {
        return $this->userFirstName;
    }

    public function setUserFirstName(string $userFirstName): self
    {
        $this->userFirstName = $userFirstName;

        return $this;
    }

    public function getUserLastName(): ?string
    {
        return $this->userLastName;
    }

    public function setUserLastName(string $userLastName): self
    {
        $this->userLastName = $userLastName;

        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getUserContact(): ?string
    {
        return $this->userContact;
    }

    public function setUserContact(string $userContact): self
    {
        $this->userContact = $userContact;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }



    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
       return $this->roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list($this->id,
            $this->username,
            $this->password) = unserialize($serialized);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getAddress(): ?ScapeUserAddress
    {
        return $this->address;
    }

    public function setAddress(ScapeUserAddress $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getVerified(): ?string
    {
        return $this->verified;
    }

    public function setVerified(string $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * @return Collection|ScapeProperties[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(ScapeProperties $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setScapeUser($this);
        }

        return $this;
    }

    public function removeProperty(ScapeProperties $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getScapeUser() === $this) {
                $property->setScapeUser(null);
            }
        }

        return $this;
    }

    public function getProfilePicPath(): ?string
    {
        return $this->profilePicPath;
    }

    public function setProfilePicPath(?string $profilePicPath): self
    {
        $this->profilePicPath = $profilePicPath;

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointment(): Collection
    {
        return $this->appointment;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointment->contains($appointment)) {
            $this->appointment[] = $appointment;
            $appointment->setScapeUser($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointment->contains($appointment)) {
            $this->appointment->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getScapeUser() === $this) {
                $appointment->setScapeUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getVendorAppointment(): Collection
    {
        return $this->vendorAppointment;
    }

    public function addVendorAppointment(Appointment $vendorAppointment): self
    {
        if (!$this->vendorAppointment->contains($vendorAppointment)) {
            $this->vendorAppointment[] = $vendorAppointment;
            $vendorAppointment->setSacpeVendor($this);
        }

        return $this;
    }

    public function removeVendorAppointment(Appointment $vendorAppointment): self
    {
        if ($this->vendorAppointment->contains($vendorAppointment)) {
            $this->vendorAppointment->removeElement($vendorAppointment);
            // set the owning side to null (unless already changed)
            if ($vendorAppointment->getSacpeVendor() === $this) {
                $vendorAppointment->setSacpeVendor(null);
            }
        }

        return $this;
    }
}
