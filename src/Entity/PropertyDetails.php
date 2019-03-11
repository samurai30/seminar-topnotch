<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyDetailsRepository")
 */
class PropertyDetails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $propPrice;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $propBHK;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropPrice(): ?int
    {
        return $this->propPrice;
    }

    public function setPropPrice(int $propPrice): self
    {
        $this->propPrice = $propPrice;

        return $this;
    }

    public function getPropBHK(): ?string
    {
        return $this->propBHK;
    }

    public function setPropBHK(string $propBHK): self
    {
        $this->propBHK = $propBHK;

        return $this;
    }
}
