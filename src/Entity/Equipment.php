<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentRepository")
 */
class Equipment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $washer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $handwashing;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tumbleDryer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $airDrying;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ironing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWasher(): ?bool
    {
        return $this->washer;
    }

    public function setWasher(bool $washer): self
    {
        $this->washer = $washer;

        return $this;
    }

    public function getHandwashing(): ?bool
    {
        return $this->handwashing;
    }

    public function setHandwashing(bool $handwashing): self
    {
        $this->handwashing = $handwashing;

        return $this;
    }

    public function getTumbleDryer(): ?bool
    {
        return $this->tumbleDryer;
    }

    public function setTumbleDryer(bool $tumbleDryer): self
    {
        $this->tumbleDryer = $tumbleDryer;

        return $this;
    }

    public function getAirDrying(): ?bool
    {
        return $this->airDrying;
    }

    public function setAirDrying(bool $airDrying): self
    {
        $this->airDrying = $airDrying;

        return $this;
    }

    public function getIroning(): ?bool
    {
        return $this->ironing;
    }

    public function setIroning(bool $ironing): self
    {
        $this->ironing = $ironing;

        return $this;
    }
}
