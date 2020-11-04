<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514103303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE practicas DROP FOREIGN KEY FK_EE798AACFC28E5EE');
        $this->addSql('DROP INDEX IDX_EE798AACFC28E5EE ON practicas');
        $this->addSql('ALTER TABLE practicas CHANGE fecha fecha VARCHAR(255) NOT NULL, CHANGE hora hora VARCHAR(255) NOT NULL, CHANGE alumno_id usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE practicas ADD CONSTRAINT FK_EE798AACDB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('CREATE INDEX IDX_EE798AACDB38439E ON practicas (usuario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE practicas DROP FOREIGN KEY FK_EE798AACDB38439E');
        $this->addSql('DROP INDEX IDX_EE798AACDB38439E ON practicas');
        $this->addSql('ALTER TABLE practicas CHANGE fecha fecha DATE NOT NULL, CHANGE hora hora TIME NOT NULL, CHANGE usuario_id alumno_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE practicas ADD CONSTRAINT FK_EE798AACFC28E5EE FOREIGN KEY (alumno_id) REFERENCES usuarios (id)');
        $this->addSql('CREATE INDEX IDX_EE798AACFC28E5EE ON practicas (alumno_id)');
    }
}
