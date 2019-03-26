<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyImagesRepository")
 */
class PropertyImages
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
    private $imagePath;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScapeProperties", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getProperty(): ?ScapeProperties
    {
        return $this->property;
    }

    public function setProperty(?ScapeProperties $property): self
    {
        $this->property = $property;

        return $this;
    }
}
