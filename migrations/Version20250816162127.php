<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250816162127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE placements_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE positions_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE placements (id INT NOT NULL, player_id INT DEFAULT NULL, position_id INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCFE397999E6F5DF ON placements (player_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCFE3979DD842E46 ON placements (position_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE positions (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD CONSTRAINT FK_FCFE397999E6F5DF FOREIGN KEY (player_id) REFERENCES players (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD CONSTRAINT FK_FCFE3979DD842E46 FOREIGN KEY (position_id) REFERENCES positions (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE placements_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE positions_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP CONSTRAINT FK_FCFE397999E6F5DF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP CONSTRAINT FK_FCFE3979DD842E46
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE placements
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE positions
        SQL);
    }
}
