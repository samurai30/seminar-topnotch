<?php

namespace App\Entity;

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
     * @ORM\JoinColumn(nullable=false)
     */
    private $featured;

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
}
