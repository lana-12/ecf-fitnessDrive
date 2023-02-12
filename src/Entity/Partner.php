<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
#[ORM\Table(name: '`partners`')]
#[UniqueEntity(fields:'namePartner', message:'Le nom que vous avez indiqué existe déjà')]
#[UniqueEntity(fields:'phone', message:'Le numéro de téléphone que vous avez indiqué existe déjà ')]
#[UniqueEntity(fields:'name', message: 'Le nom que vous avez indiqué existe déjà')]


class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique:true)]
    private ?string $namePartner = null;

    #[ORM\Column(length: 50,unique:true)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?bool $is_active = null;


    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: Structure::class)]
    private Collection $structures;

    #[ORM\ManyToOne(inversedBy: 'partner', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(length: 150, unique:true)]
    private ?string $name = null;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePartner(): ?string
    {
        return $this->namePartner;
    }

    public function setNamePartner(string $namePartner): self
    {
        $this->namePartner = $namePartner;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }


    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setPartner($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPartner() === $this) {
                $structure->setPartner(null);
            }
        }

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}


