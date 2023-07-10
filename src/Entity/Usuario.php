<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Perfil $perfil = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(type: "uuid", unique: true)]
    private ?Uuid $uuid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    // public function getUserIdentifier(): string
    // {
    //     return (string) $this->email;
    // }
    public function getUserIdentifier(): string
    {
        return $this->uuid->toRfc4122();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->perfil->getRoles();
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        // return array_unique($roles);
        $roles_arr = [];
        foreach($this->perfil->getRoles() as $rol){
            array_push($roles_arr,$rol->getNombre());
        }
        return $roles_arr;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPerfil(): ?perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?perfil $perfil): static
    {
        $this->perfil = $perfil;

        return $this;
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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
