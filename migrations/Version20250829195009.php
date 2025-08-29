<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250829195009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE match_infos_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE match_infos (id INT NOT NULL, match INT DEFAULT NULL, pre_match_info VARCHAR(255) NOT NULL, post_match_info VARCHAR(255) NOT NULL, home_team_info VARCHAR(255) NOT NULL, away_team_info VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_50A0FDCC7A5BC505 ON match_infos (match)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ADD CONSTRAINT FK_50A0FDCC7A5BC505 FOREIGN KEY (match) REFERENCES matchs (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations ALTER is_substitute DROP DEFAULT
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE match_infos_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos DROP CONSTRAINT FK_50A0FDCC7A5BC505
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE match_infos
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations ALTER is_substitute SET DEFAULT false
        SQL);
    }
}
