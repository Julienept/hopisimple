<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $notation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="rating")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="serviceNote")
     */
    private $provider;

    public function __construct()
    {
        $this->provider = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotation(): ?float
    {
        return $this->notation;
    }

    public function setNotation(?float $notation): self
    {
        $this->notation = $notation;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $user): self
    {
        $this->author = $author;

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

    /**
     * @return Collection|User[]
     */
    public function getProvider(): Collection
    {
        return $this->provider;
    }

    public function addProvider(User $provider): self
    {
        if (!$this->provider->contains($provider)) {
            $this->provider[] = $provider;
            $provider->setServiceNote($this);
        }

        return $this;
    }

    public function removeProvider(User $provider): self
    {
        if ($this->provider->contains($provider)) {
            $this->provider->removeElement($provider);
            // set the owning side to null (unless already changed)
            if ($provider->getServiceNote() === $this) {
                $provider->setServiceNote(null);
            }
        }

        return $this;
    }
}
