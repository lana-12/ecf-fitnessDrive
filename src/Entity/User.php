<?php

namespace App\Entity;

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


    #[ORM\Column(length: 254, unique:true)]
    // #[Assert\Email()]
    private ?string $email = null;



    #[ORM\Column(length: 60)]
    private ?string $password = null;

    // #[Assert\NotBlank(message: 'Veuillez saisir un mot de passe!')]
    // #[Assert\EqualTo(propertyPath:'password', message:'Vous n\'avez pas tapé le même mot de passe')]
    // private ?string $confirmPassword = null;



    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(type: "json")]
    private ?array $roles = null;



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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }


    // public function getConfirmPassword(): ?string
    // {
    //     return $this->confirmPassword;
    // }

    // public function setConfirmPassword(string $confirmPassword): self
    // {
    //     $this->confirmPassword = $confirmPassword;

    //     return $this;
    // }

    public function getUserIdentifier(): string
    {
        return(string) $this->email;
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

    public function getRoles(): array
    {
        
        $roles = $this->roles;
        // $roles[] ='ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    public function getSalt()
    {

    }


    public function eraseCredentials()
    {
        
    }
    
}
