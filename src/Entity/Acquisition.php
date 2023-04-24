<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Acquisition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="acquisitions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Announcement", inversedBy="acquisitions")
     * @ORM\JoinColumn(name="annonce_id", referencedColumnName="id")
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="acquisitions")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnnonce(): ?Announcement
    {
        return $this->annonce;
    }

    public function setAnnonce(?Announcement $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}