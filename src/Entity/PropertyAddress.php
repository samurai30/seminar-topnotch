<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyAddressRepository")
 */
class PropertyAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $propDistrict;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $propTaluka;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $propCity;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ScapeProperties", mappedBy="propertyAddress", cascade={"persist", "remove"})
     */
    private $scapeProperty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropDistrict(): ?string
    {
        return $this->propDistrict;
    }

    public function setPropDistrict(string $propDistrict): self
    {
        $this->propDistrict = $propDistrict;

        return $this;
    }

    public function getPropTaluka(): ?string
    {
        return $this->propTaluka;
    }

    public function setPropTaluka(string $propTaluka): self
    {
        $this->propTaluka = $propTaluka;

        return $this;
    }

    public function getPropCity(): ?string
    {
        return $this->propCity;
    }

    public function setPropCity(string $propCity): self
    {
        $this->propCity = $propCity;

        return $this;
    }

    public function getScapeProperty(): ?ScapeProperties
    {
        return $this->scapeProperty;
    }

    public function setScapeProperty(ScapeProperties $scapeProperty): self
    {
        $this->scapeProperty = $scapeProperty;

        // set the owning side of the relation if necessary
        if ($this !== $scapeProperty->getPropertyAddress()) {
            $scapeProperty->setPropertyAddress($this);
        }

        return $this;
    }


}
