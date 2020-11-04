<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519105316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE practicas (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, usuario VARCHAR(255) NOT NULL, profesor VARCHAR(255) NOT NULL, hora VARCHAR(255) NOT NULL, fecha VARCHAR(255) NOT NULL, confirmado VARCHAR(255) DEFAULT NULL, INDEX IDX_EE798AAC7EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE practicas ADD CONSTRAINT FK_EE798AAC7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE practicas');
    }
}
