<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Commentary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Announcement", inversedBy="commentaries")
     * @ORM\JoinColumn(name="annonce_id", referencedColumnName="id")
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="commentaries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
