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
    private ?bool $sellDrinks = null;

    #[ORM\Column]
    private ?bool $saleVitaminBar = null;

    #[ORM\Column]
    private ?bool $manageSchedule = null;

    #[ORM\Column]
    private ?bool $sendNewsletter = null;

    #[ORM\Column]
    private ?bool $lockerRoom = null;

    #[ORM\Column]
    private ?bool $shower = null;

    #[ORM\Column]
    private ?bool $sportsCoach = null;

    #[ORM\Column]
    private ?bool $appFitnessDrive = null;

    #[ORM\Column]
    private ?bool $shopFitnessDrive = null;

    #[ORM\Column]
    private ?bool $saleOtherProducts = null;

    #[ORM\ManyToMany(targetEntity: Structure::class, mappedBy: 'perms')]
    private Collection $structures;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSellDrinks(): ?bool
    {
        return $this->sellDrinks;
    }

    public function setSellDrinks(bool $sellDrinks): self
    {
        $this->sellDrinks = $sellDrinks;

        return $this;
    }

    public function isSaleVitaminBar(): ?bool
    {
        return $this->saleVitaminBar;
    }

    public function setSaleVitaminBar(bool $saleVitaminBar): self
    {
        $this->saleVitaminBar = $saleVitaminBar;

        return $this;
    }

    public function isManageSchedule(): ?bool
    {
        return $this->manageSchedule;
    }

    public function setManageSchedule(bool $manageSchedule): self
    {
        $this->manageSchedule = $manageSchedule;

        return $this;
    }

    public function isSendNewsletter(): ?bool
    {
        return $this->sendNewsletter;
    }

    public function setSendNewsletter(bool $sendNewsletter): self
    {
        $this->sendNewsletter = $sendNewsletter;

        return $this;
    }

    public function isLockerRoom(): ?bool
    {
        return $this->lockerRoom;
    }

    public function setLockerRoom(bool $lockerRoom): self
    {
        $this->lockerRoom = $lockerRoom;

        return $this;
    }

    public function isShower(): ?bool
    {
        return $this->shower;
    }

    public function setShower(bool $shower): self
    {
        $this->shower = $shower;

        return $this;
    }

    public function isSportsCoach(): ?bool
    {
        return $this->sportsCoach;
    }

    public function setSportsCoach(bool $sportsCoach): self
    {
        $this->sportsCoach = $sportsCoach;

        return $this;
    }

    public function isAppFitnessDrive(): ?bool
    {
        return $this->appFitnessDrive;
    }

    public function setAppFitnessDrive(bool $appFitnessDrive): self
    {
        $this->appFitnessDrive = $appFitnessDrive;

        return $this;
    }

    public function isShopFitnessDrive(): ?bool
    {
        return $this->shopFitnessDrive;
    }

    public function setShopFitnessDrive(bool $shopFitnessDrive): self
    {
        $this->shopFitnessDrive = $shopFitnessDrive;

        return $this;
    }

    public function isSaleOtherProducts(): ?bool
    {
        return $this->saleOtherProducts;
    }

    public function setSaleOtherProducts(bool $saleOtherProducts): self
    {
        $this->saleOtherProducts = $saleOtherProducts;

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
            $structure->addPerm($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            $structure->removePerm($this);
        }

        return $this;
    }
}
