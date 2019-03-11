<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyCategoryRepository")
 */
class PropertyCategory
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
    private $categoryName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ScapeProperties", mappedBy="category", orphanRemoval=true)
     */
    private $scapeProperties;

    public function __construct()
    {
        $this->scapeProperties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return Collection|ScapeProperties[]
     */
    public function getScapeProperties(): Collection
    {
        return $this->scapeProperties;
    }

    public function addScapeProperty(ScapeProperties $scapeProperty): self
    {
        if (!$this->scapeProperties->contains($scapeProperty)) {
            $this->scapeProperties[] = $scapeProperty;
            $scapeProperty->setCategory($this);
        }

        return $this;
    }

    public function removeScapeProperty(ScapeProperties $scapeProperty): self
    {
        if ($this->scapeProperties->contains($scapeProperty)) {
            $this->scapeProperties->removeElement($scapeProperty);
            // set the owning side to null (unless already changed)
            if ($scapeProperty->getCategory() === $this) {
                $scapeProperty->setCategory(null);
            }
        }

        return $this;
    }
}
