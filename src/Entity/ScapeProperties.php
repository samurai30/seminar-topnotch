<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScapePropertiesRepository")
 */
class ScapeProperties
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $propName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $propNotes;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $propStatus;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PropertyAddress", inversedBy="scapeProperty", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $propertyAddress;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PropertyCategory", inversedBy="scapeProperties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Featured", inversedBy="scapeProperty")
     * @ORM\JoinColumn(nullable=true)
     */
    private $featured;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PropertyDetails", inversedBy="scapeProperty", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $propDetails;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScapeUser", inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scapeUser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PropertyImages", mappedBy="property", orphanRemoval=true)
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropName(): ?string
    {
        return $this->propName;
    }

    public function setPropName(string $propName): self
    {
        $this->propName = $propName;

        return $this;
    }

    public function getPropNotes(): ?string
    {
        return $this->propNotes;
    }

    public function setPropNotes(?string $propNotes): self
    {
        $this->propNotes = $propNotes;

        return $this;
    }

    public function getPropStatus(): ?string
    {
        return $this->propStatus;
    }

    public function setPropStatus(string $propStatus): self
    {
        $this->propStatus = $propStatus;

        return $this;
    }

    public function getPropertyAddress(): ?PropertyAddress
    {
        return $this->propertyAddress;
    }

    public function setPropertyAddress(PropertyAddress $propertyAddress): self
    {
        $this->propertyAddress = $propertyAddress;

        return $this;
    }

    public function getCategory(): ?PropertyCategory
    {
        return $this->category;
    }

    public function setCategory(?PropertyCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFeatured(): ?Featured
    {
        return $this->featured;
    }

    public function setFeatured(?Featured $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function getPropDetails(): ?PropertyDetails
    {
        return $this->propDetails;
    }

    public function setPropDetails(PropertyDetails $propDetails): self
    {
        $this->propDetails = $propDetails;

        return $this;
    }

    public function getScapeUser(): ?ScapeUser
    {
        return $this->scapeUser;
    }

    public function setScapeUser(?ScapeUser $scapeUser): self
    {
        $this->scapeUser = $scapeUser;

        return $this;
    }

    /**
     * @return Collection|PropertyImages[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(PropertyImages $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProperty($this);
        }

        return $this;
    }

    public function removeImage(PropertyImages $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getProperty() === $this) {
                $image->setProperty(null);
            }
        }

        return $this;
    }
}
