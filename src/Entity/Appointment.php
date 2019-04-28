<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScapeUser", inversedBy="appointment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scapeUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScapeUser", inversedBy="vendorAppointment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sacpeVendor;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $appStatus;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $appDate;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $appTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScapeProperties", inversedBy="scapeAppointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scapeProperty;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSacpeVendor(): ?ScapeUser
    {
        return $this->sacpeVendor;
    }

    public function setSacpeVendor(?ScapeUser $sacpeVendor): self
    {
        $this->sacpeVendor = $sacpeVendor;

        return $this;
    }

    public function getAppStatus(): ?string
    {
        return $this->appStatus;
    }

    public function setAppStatus(string $appStatus): self
    {
        $this->appStatus = $appStatus;

        return $this;
    }

    public function getAppDate(): ?\DateTimeInterface
    {
        return $this->appDate;
    }

    public function setAppDate(?\DateTimeInterface $appDate): self
    {
        $this->appDate = $appDate;

        return $this;
    }

    public function getAppTime(): ?\DateTimeInterface
    {
        return $this->appTime;
    }

    public function setAppTime(?\DateTimeInterface $appTime): self
    {
        $this->appTime = $appTime;

        return $this;
    }

    public function getScapeProperty(): ?ScapeProperties
    {
        return $this->scapeProperty;
    }

    public function setScapeProperty(?ScapeProperties $scapeProperty): self
    {
        $this->scapeProperty = $scapeProperty;

        return $this;
    }
}
