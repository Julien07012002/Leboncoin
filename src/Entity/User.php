<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="user")
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity="Commentary", mappedBy="user")
     */
    private $commentaries;

    /**
     * @ORM\OneToMany(targetEntity="Bank", mappedBy="user")
     */
    private $banks;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity="Acquisition", mappedBy="user")
     */
    private $acquisitions;

    
    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->commentaries = new ArrayCollection();
        $this->banks = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->acquisitions = new ArrayCollection();
    }

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setUser($this);
        }

        return $this; 
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->contains($annonce)) {
            $this->annonces->removeElement($annonce);
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }

    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setUser($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentaries->contains($commentary)) {
            $this->commentaries->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getUser() === $this) {
                $commentary->setUser(null);
            }
        }

        return $this;
    }

    public function getBanks(): Collection
    {
        return $this->banks;
    }

    public function addBank(Bank $bank): self
    {
        if (!$this->banks->contains($bank)) {
            $this->banks[] = $bank;
            $bank->setUser($this);
        }

        return $this;
    }

    public function removeBank(Bank $bank): self
    {
        if ($this->banks->contains($bank)) {
            $this->banks->removeElement($bank);
            // set the owning side to null (unless already changed)
            if ($bank->getUser() === $this) {
                $bank->setUser(null);
            }
        }

        return $this;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }

        return $this;
    }

    public function getAcquisitions(): Collection
    {
        return $this->acquisitions;
    }

    public function addAcquisition(Acquisition $acquisition): self
    {
        if (!$this->acquisitions->contains($acquisition)) {
            $this->acquisitions[] = $acquisition;
            $acquisition->setUser($this);
        }

        return $this;
    }

    public function removeAcquisition(Acquisition $acquisition): self
    {
        if ($this->acquisitions->contains($acquisition)) {
            $this->acquisitions->removeElement($acquisition);
            // set the owning side to null (unless already changed)
            if ($acquisition->getUser() === $this) {
                $acquisition->setUser(null);
            }
        }

        return $this;
    }

}