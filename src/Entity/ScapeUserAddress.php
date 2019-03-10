<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScapeUserAddressRepository")
 */
class ScapeUserAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $pincode;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPincode(): ?string
    {
        return $this->pincode;
    }

    public function setPincode(string $pincode): self
    {
        $this->pincode = $pincode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }


}