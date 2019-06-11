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
     * @ORM\Column(type="boolean")
     */
    private $atHome;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atLaundryService;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atFriendsPlace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAtHome(): ?bool
    {
        return $this->atHome;
    }

    public function setAtHome(bool $atHome): self
    {
        $this->atHome = $atHome;

        return $this;
    }

    public function getAtLaundryService(): ?bool
    {
        return $this->atLaundryService;
    }

    public function setAtLaundryService(bool $atLaundryService): self
    {
        $this->atLaundryService = $atLaundryService;

        return $this;
    }

    public function getAtFriendsPlace(): ?bool
    {
        return $this->atFriendsPlace;
    }

    public function setAtFriendsPlace(bool $atFriendsPlace): self
    {
        $this->atFriendsPlace = $atFriendsPlace;

        return $this;
    }
}
