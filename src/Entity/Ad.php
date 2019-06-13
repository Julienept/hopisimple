<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 */
class Ad
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="ads", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="ads")
     */
    private $tags;

    /**
     * @ORM\Column(type="boolean")
     */
    private $privateTransport;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publicTransport;

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
    private $dedicatedPlace;

    /**
     * @ORM\Column(type="boolean")
     */
    private $washer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $handwashinhandwashing;

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



    
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function __toString()
     {
        return $this->place;
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    public function getPrivateTransport(): ?bool
    {
        return $this->privateTransport;
    }

    public function setPrivateTransport(bool $privateTransport): self
    {
        $this->privateTransport = $privateTransport;

        return $this;
    }

    public function getPublicTransport(): ?bool
    {
        return $this->publicTransport;
    }

    public function setPublicTransport(bool $publicTransport): self
    {
        $this->publicTransport = $publicTransport;

        return $this;
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

    public function getDedicatedPlace(): ?bool
    {
        return $this->dedicatedPlace;
    }

    public function setDedicatedPlace(?bool $dedicatedPlace): self
    {
        $this->dedicatedPlace = $dedicatedPlace;

        return $this;
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

    public function getHandwashinhandwashing(): ?bool
    {
        return $this->handwashinhandwashing;
    }

    public function setHandwashinhandwashing(bool $handwashinhandwashing): self
    {
        $this->handwashinhandwashing = $handwashinhandwashing;

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
