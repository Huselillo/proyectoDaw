<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428171720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tests_preguntas (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tests_preguntas_tests (tests_preguntas_id INT NOT NULL, tests_id INT NOT NULL, INDEX IDX_507F0758867018D6 (tests_preguntas_id), INDEX IDX_507F0758F5D80971 (tests_id), PRIMARY KEY(tests_preguntas_id, tests_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tests_preguntas_preguntas (tests_preguntas_id INT NOT NULL, preguntas_id INT NOT NULL, INDEX IDX_F10BA59A867018D6 (tests_preguntas_id), INDEX IDX_F10BA59A1D4F25C6 (preguntas_id), PRIMARY KEY(tests_preguntas_id, preguntas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tests_preguntas_tests ADD CONSTRAINT FK_507F0758867018D6 FOREIGN KEY (tests_preguntas_id) REFERENCES tests_preguntas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tests_preguntas_tests ADD CONSTRAINT FK_507F0758F5D80971 FOREIGN KEY (tests_id) REFERENCES tests (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tests_preguntas_preguntas ADD CONSTRAINT FK_F10BA59A867018D6 FOREIGN KEY (tests_preguntas_id) REFERENCES tests_preguntas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tests_preguntas_preguntas ADD CONSTRAINT FK_F10BA59A1D4F25C6 FOREIGN KEY (preguntas_id) REFERENCES preguntas (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tests_preguntas_tests DROP FOREIGN KEY FK_507F0758867018D6');
        $this->addSql('ALTER TABLE tests_preguntas_preguntas DROP FOREIGN KEY FK_F10BA59A867018D6');
        $this->addSql('DROP TABLE tests_preguntas');
        $this->addSql('DROP TABLE tests_preguntas_tests');
        $this->addSql('DROP TABLE tests_preguntas_preguntas');
    }
}
