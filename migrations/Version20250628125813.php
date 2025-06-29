<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250628125813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE Match_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE Match (id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, scoreHome INT NOT NULL, scoreAway INT NOT NULL, isPrepared BOOLEAN NOT NULL, infos VARCHAR(255) NOT NULL, identificationCode VARCHAR(255) NOT NULL, homeTeam_id INT DEFAULT NULL, awayTeam_id INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BB9AEA01EFE66F0C ON Match (homeTeam_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BB9AEA016DF247E5 ON Match (awayTeam_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Match ADD CONSTRAINT FK_BB9AEA01EFE66F0C FOREIGN KEY (homeTeam_id) REFERENCES Team (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Match ADD CONSTRAINT FK_BB9AEA016DF247E5 FOREIGN KEY (awayTeam_id) REFERENCES Team (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE Match_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Match DROP CONSTRAINT FK_BB9AEA01EFE66F0C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Match DROP CONSTRAINT FK_BB9AEA016DF247E5
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE Match
        SQL);
    }
}
