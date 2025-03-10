<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428091003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tests_preguntas (tests_id INT NOT NULL, preguntas_id INT NOT NULL, INDEX IDX_82504261F5D80971 (tests_id), INDEX IDX_825042611D4F25C6 (preguntas_id), PRIMARY KEY(tests_id, preguntas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tests_preguntas ADD CONSTRAINT FK_82504261F5D80971 FOREIGN KEY (tests_id) REFERENCES tests (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tests_preguntas ADD CONSTRAINT FK_825042611D4F25C6 FOREIGN KEY (preguntas_id) REFERENCES preguntas (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tests_preguntas');
    }
}
