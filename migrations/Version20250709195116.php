<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709195116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE notes DROP CONSTRAINT fk_11ba68c6ace3b73
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_11ba68c6ace3b73
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes RENAME COLUMN participation_id TO participation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes ADD CONSTRAINT FK_11BA68CAB55E24F FOREIGN KEY (participation) REFERENCES participations (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_11BA68CAB55E24F ON notes (participation)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes DROP CONSTRAINT FK_11BA68CAB55E24F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_11BA68CAB55E24F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes RENAME COLUMN participation TO participation_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes ADD CONSTRAINT fk_11ba68c6ace3b73 FOREIGN KEY (participation_id) REFERENCES participations (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_11ba68c6ace3b73 ON notes (participation_id)
        SQL);
    }
}
