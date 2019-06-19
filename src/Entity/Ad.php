<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="ads")
     */
    private $tags;
  

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Establishment", inversedBy="ad", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $establishment;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Transport", inversedBy="ad", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $transport;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Bonus", inversedBy="ad", cascade={"persist", "remove"})
     */
    private $bonus;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Equipment", inversedBy="ad", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipment;



    
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->createdAt = new DateTime();

    }

    public function __toString()
     {
         return (string) $this->user;
     }

    // public function __toString()
    //  {
    //     return $this->user;
    //     return $this->publicTransport;
    //     return $this->privateTransport;
    //     return $this->AtHome;
    //     return $this->atLaundryService;
    //     return $this->atFriendsPlace;
    //     return $this->gentleHouseholdProduct;
    //     return $this->hospitalProduct;
    //     return $this->earthProtection;
    //     return $this->dedicatedPlace;
    //     return $this->washer;
    //     return $this->handwashinhandwashing;
    //     return $this->tumbleDryer;
    //     return $this->airDrying;
    //     return $this->ironing;
        


    // }

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


    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }

    public function setEstablishment(Establishment $establishment): self
    {
        $this->establishment = $establishment;

        return $this;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(Transport $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getBonus(): ?Bonus
    {
        return $this->bonus;
    }

    public function setBonus(?Bonus $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    public function setEquipment(Equipment $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }


}
