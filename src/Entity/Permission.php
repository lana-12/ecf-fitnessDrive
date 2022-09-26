<?php

namespace App\Entity;

use App\Repository\PermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
#[ORM\Table(name: '`permissions`')]
class Permission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_sellDrinks = null;

    #[ORM\Column]
    private ?bool $is_saleVitaminBar = null;

    #[ORM\Column]
    private ?bool $is_manageSchedule = null;

    #[ORM\Column]
    private ?bool $is_sendNewsletter = null;

    #[ORM\Column]
    private ?bool $is_lockerRoom = null;

    #[ORM\Column]
    private ?bool $is_shower = null;

    #[ORM\Column]
    private ?bool $is_sportsCoach = null;

    #[ORM\Column]
    private ?bool $is_appFitnessDrive = null;

    #[ORM\Column]
    private ?bool $is_shopFitnessDrive = null;

    #[ORM\ManyToMany(targetEntity: Structure::class, mappedBy: 'permissions')]
    private Collection $structures;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsSellDrinks(): ?bool
    {
        return $this->is_sellDrinks;
    }

    public function setIsSellDrinks(bool $is_sellDrinks): self
    {
        $this->is_sellDrinks = $is_sellDrinks;

        return $this;
    }

    public function isIsSaleVitaminBar(): ?bool
    {
        return $this->is_saleVitaminBar;
    }

    public function setIsSaleVitaminBar(bool $is_saleVitaminBar): self
    {
        $this->is_saleVitaminBar = $is_saleVitaminBar;

        return $this;
    }

    public function isIsManageSchedule(): ?bool
    {
        return $this->is_manageSchedule;
    }

    public function setIsManageSchedule(bool $is_manageSchedule): self
    {
        $this->is_manageSchedule = $is_manageSchedule;

        return $this;
    }

    public function isIsSendNewsletter(): ?bool
    {
        return $this->is_sendNewsletter;
    }

    public function setIsSendNewsletter(bool $is_sendNewsletter): self
    {
        $this->is_sendNewsletter = $is_sendNewsletter;

        return $this;
    }

    public function isIsLockerRoom(): ?bool
    {
        return $this->is_lockerRoom;
    }

    public function setIsLockerRoom(bool $is_lockerRoom): self
    {
        $this->is_lockerRoom = $is_lockerRoom;

        return $this;
    }

    public function isIsShower(): ?bool
    {
        return $this->is_shower;
    }

    public function setIsShower(bool $is_shower): self
    {
        $this->is_shower = $is_shower;

        return $this;
    }

    public function isIsSportsCoach(): ?bool
    {
        return $this->is_sportsCoach;
    }

    public function setIsSportsCoach(bool $is_sportsCoach): self
    {
        $this->is_sportsCoach = $is_sportsCoach;

        return $this;
    }

    public function isIsAppFitnessDrive(): ?bool
    {
        return $this->is_appFitnessDrive;
    }

    public function setIsAppFitnessDrive(bool $is_appFitnessDrive): self
    {
        $this->is_appFitnessDrive = $is_appFitnessDrive;

        return $this;
    }

    public function isIsShopFitnessDrive(): ?bool
    {
        return $this->is_shopFitnessDrive;
    }

    public function setIsShopFitnessDrive(bool $is_shopFitnessDrive): self
    {
        $this->is_shopFitnessDrive = $is_shopFitnessDrive;

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
            $structure->addPermission($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            $structure->removePermission($this);
        }

        return $this;
    }
}
