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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $earthProtection;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dedicatedSpace;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ad", mappedBy="bonus", cascade={"persist", "remove"})
     */
    private $ad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductType(): ?string
    {
        return $this->productType;
    }

    public function setProductType(?string $productType): self
    {
        $this->productType = $productType;

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

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        // set (or unset) the owning side of the relation if necessary
        $newBonus = $ad === null ? null : $this;
        if ($newBonus !== $ad->getBonus()) {
            $ad->setBonus($newBonus);
        }

        return $this;
    }
}
