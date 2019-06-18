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
     * @ORM\Column(type="string", length=255)
     */
    private $washing;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $drying;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ironing;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ad", mappedBy="equipment", cascade={"persist", "remove"})
     */
    private $ad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWashing(): ?string
    {
        return $this->washing;
    }

    public function setWashing(string $washing): self
    {
        $this->washing = $washing;

        return $this;
    }

    public function getDrying(): ?string
    {
        return $this->drying;
    }

    public function setDrying(string $drying): self
    {
        $this->drying = $drying;

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

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(Ad $ad): self
    {
        $this->ad = $ad;

        // set the owning side of the relation if necessary
        if ($this !== $ad->getEquipment()) {
            $ad->setEquipment($this);
        }

        return $this;
    }
}
