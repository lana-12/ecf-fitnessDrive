<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
#[UniqueEntity(fields:'email', message:'L\'email que vous avez indiqué est déjà utiliser')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 255, unique:true)]
    private ?string $email = null;

    #[ORM\Column(length: 60)]
    private ?string $password = null;

    #[Assert\NotBlank(message: 'Veuillez saisir un mot de passe!')]
    #[Assert\EqualTo(propertyPath:'password', message:'Vous n\'avez pas tapé le même mot de passe')]
    private ?string $confirmPassword = null;

    #[ORM\Column()]
    private array $roles = [];

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Partner $partner = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Structure $structure = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Admin $adminUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getUserIdentifier(): string
    {
        return(string) $this->email;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles; 
        return array_unique($roles);

    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        // unset the owning side of the relation if necessary
        if ($partner === null && $this->partner !== null) {
            $this->partner->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($partner !== null && $partner->getUser() !== $this) {
            $partner->setUser($this);
        }

        $this->partner = $partner;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getAdminUser(): ?Admin
    {
        return $this->adminUser;
    }

    public function setAdminUser(?Admin $adminUser): self
    {
        $this->adminUser = $adminUser;

        return $this;
    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {
        
    }
}
