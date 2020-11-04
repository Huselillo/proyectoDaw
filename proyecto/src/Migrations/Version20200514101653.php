<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514101653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE practicas (id INT AUTO_INCREMENT NOT NULL, alumno_id INT DEFAULT NULL, profesor_id INT DEFAULT NULL, fecha DATE NOT NULL, hora TIME NOT NULL, INDEX IDX_EE798AACFC28E5EE (alumno_id), INDEX IDX_EE798AACE52BD977 (profesor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE practicas ADD CONSTRAINT FK_EE798AACFC28E5EE FOREIGN KEY (alumno_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE practicas ADD CONSTRAINT FK_EE798AACE52BD977 FOREIGN KEY (profesor_id) REFERENCES profesores (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE practicas');
    }
}
