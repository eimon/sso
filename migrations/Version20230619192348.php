<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619192348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE perfil_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rol_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE perfil (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE perfil_rol (perfil_id INT NOT NULL, rol_id INT NOT NULL, PRIMARY KEY(perfil_id, rol_id))');
        $this->addSql('CREATE INDEX IDX_1467FB3857291544 ON perfil_rol (perfil_id)');
        $this->addSql('CREATE INDEX IDX_1467FB384BAB96C ON perfil_rol (rol_id)');
        $this->addSql('CREATE TABLE rol (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE perfil_rol ADD CONSTRAINT FK_1467FB3857291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE perfil_rol ADD CONSTRAINT FK_1467FB384BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario ADD perfil_id INT NOT NULL');
        $this->addSql('ALTER TABLE usuario ADD nombre VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE usuario ADD uuid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D57291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2265B05D57291544 ON usuario (perfil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05D57291544');
        $this->addSql('DROP SEQUENCE perfil_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rol_id_seq CASCADE');
        $this->addSql('ALTER TABLE perfil_rol DROP CONSTRAINT FK_1467FB3857291544');
        $this->addSql('ALTER TABLE perfil_rol DROP CONSTRAINT FK_1467FB384BAB96C');
        $this->addSql('DROP TABLE perfil');
        $this->addSql('DROP TABLE perfil_rol');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP INDEX IDX_2265B05D57291544');
        $this->addSql('ALTER TABLE usuario DROP perfil_id');
        $this->addSql('ALTER TABLE usuario DROP nombre');
        $this->addSql('ALTER TABLE usuario DROP uuid');
    }
}
