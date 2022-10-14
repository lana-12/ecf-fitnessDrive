<?php

namespace App\Entity;

use App\Repository\StructurePermissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructurePermissionRepository::class)]
#[ORM\Table(name: '`structure_permission`')]
class StructurePermission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $structureId = null;

    #[ORM\Column]
    private ?int $permission_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStructureId(): ?int
    {
        return $this->structureId;
    }

    public function setStructureId(int $structureId): self
    {
        $this->structureId = $structureId;

        return $this;
    }

    public function getPermissionId(): ?int
    {
        return $this->permission_id;
    }

    public function setPermissionId(int $permission_id): self
    {
        $this->permission_id = $permission_id;

        return $this;
    }
}