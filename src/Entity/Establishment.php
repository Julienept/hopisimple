<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstablishmentRepository")
 */
class Establishment
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
    private $place;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ad", mappedBy="establishment", cascade={"persist", "remove"})
     */
    private $ad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

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
        if ($this !== $ad->getEstablishment()) {
            $ad->setEstablishment($this);
        }

        return $this;
    }
}
