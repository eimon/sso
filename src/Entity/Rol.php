<?php

namespace App\Entity;

use App\Repository\RolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolRepository::class)]
class Rol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\ManyToMany(targetEntity: Perfil::class, mappedBy: 'roles')]
    private Collection $roles;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Perfil>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Perfil $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->addRole($this);
        }

        return $this;
    }

    public function removeRole(Perfil $role): static
    {
        if ($this->roles->removeElement($role)) {
            $role->removeRole($this);
        }

        return $this;
    }
}
