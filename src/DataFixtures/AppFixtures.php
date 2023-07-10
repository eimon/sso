<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Rol;
use App\Entity\Perfil;
use App\Entity\Usuario;
use Symfony\Component\Uid\UuidV1;


class AppFixtures extends Fixture
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        
        $rol = new Rol('ROLE_ADMINISTRADOR');
        $perfil = new Perfil('Administrador');
        $perfil->addRole($rol);
        $usuario = new Usuario();
        $usuario->setEmail('admin@root.com');
        $usuario->setNombre('admin');
        $usuario->setPassword($this->passwordHasherFactory->getPasswordHasher(Usuario::class)->hash('pass'));
        $usuario->setPerfil($perfil);
        $usuario->setUuid(new UuidV1());
        
        $manager->persist($rol);
        $manager->persist($perfil);
        $manager->persist($usuario);
        $manager->flush();
    }
}
