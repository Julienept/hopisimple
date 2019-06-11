<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BonusRepository")
 */
class Bonus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gentleHouseholdProduct;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hospitalProduct;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $earthProtection;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dedicatedSpace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGentleHouseholdProduct(): ?bool
    {
        return $this->gentleHouseholdProduct;
    }

    public function setGentleHouseholdProduct(?bool $gentleHouseholdProduct): self
    {
        $this->gentleHouseholdProduct = $gentleHouseholdProduct;

        return $this;
    }

    public function getHospitalProduct(): ?bool
    {
        return $this->hospitalProduct;
    }

    public function setHospitalProduct(?bool $hospitalProduct): self
    {
        $this->hospitalProduct = $hospitalProduct;

        return $this;
    }

    public function getEarthProtection(): ?bool
    {
        return $this->earthProtection;
    }

    public function setEarthProtection(?bool $earthProtection): self
    {
        $this->earthProtection = $earthProtection;

        return $this;
    }

    public function getDedicatedSpace(): ?bool
    {
        return $this->dedicatedSpace;
    }

    public function setDedicatedSpace(?bool $dedicatedSpace): self
    {
        $this->dedicatedSpace = $dedicatedSpace;

        return $this;
    }
}
