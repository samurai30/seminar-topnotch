<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeaturedRepository")
 */
class Featured
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ScapeProperties", mappedBy="featured")
     */
    private $scapeProperty;

    public function __construct()
    {
        $this->scapeProperty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|ScapeProperties[]
     */
    public function getScapeProperty(): Collection
    {
        return $this->scapeProperty;
    }

    public function addScapeProperty(ScapeProperties $scapeProperty): self
    {
        if (!$this->scapeProperty->contains($scapeProperty)) {
            $this->scapeProperty[] = $scapeProperty;
            $scapeProperty->setFeatured($this);
        }

        return $this;
    }

    public function removeScapeProperty(ScapeProperties $scapeProperty): self
    {
        if ($this->scapeProperty->contains($scapeProperty)) {
            $this->scapeProperty->removeElement($scapeProperty);
            // set the owning side to null (unless already changed)
            if ($scapeProperty->getFeatured() === $this) {
                $scapeProperty->setFeatured(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->type;
    }
}
