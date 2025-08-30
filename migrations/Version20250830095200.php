<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250830095200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ADD stadium INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ALTER infos DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041E604044F FOREIGN KEY (stadium) REFERENCES stadiums (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6B1E6041E604044F ON matchs (stadium)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stadiums DROP CONSTRAINT fk_fd8b970ea5aed08c
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_fd8b970ea5aed08c
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stadiums DROP matchdoctrine_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stadiums ADD matchdoctrine_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stadiums ADD CONSTRAINT fk_fd8b970ea5aed08c FOREIGN KEY (matchdoctrine_id) REFERENCES matchs (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_fd8b970ea5aed08c ON stadiums (matchdoctrine_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs DROP CONSTRAINT FK_6B1E6041E604044F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_6B1E6041E604044F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs DROP stadium
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ALTER infos SET NOT NULL
        SQL);
    }
}
