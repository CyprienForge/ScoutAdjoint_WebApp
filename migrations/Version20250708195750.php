<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250708195750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE championships_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE matchs_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE notes_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE participations_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE players_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE teams_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE championships (id INT NOT NULL, name VARCHAR(255) NOT NULL, level INT DEFAULT NULL, identification_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE matchs (id INT NOT NULL, home_team INT DEFAULT NULL, away_team INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, score_home INT NOT NULL, score_away INT NOT NULL, is_prepared BOOLEAN NOT NULL, infos VARCHAR(255) NOT NULL, identification_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6B1E6041E5C617D0 ON matchs (home_team)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6B1E6041558F2381 ON matchs (away_team)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE notes (id INT NOT NULL, participation_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, minute INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_11BA68C6ACE3B73 ON notes (participation_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE participations (id INT NOT NULL, player INT DEFAULT NULL, match INT DEFAULT NULL, team INT DEFAULT NULL, numero INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FDC6C6E898197A65 ON participations (player)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FDC6C6E87A5BC505 ON participations (match)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FDC6C6E8C4E0A61F ON participations (team)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE players (id INT NOT NULL, team INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, identification_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_264E43A6C4E0A61F ON players (team)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE teams (id INT NOT NULL, championship INT DEFAULT NULL, name VARCHAR(255) NOT NULL, logo_path VARCHAR(255) DEFAULT NULL, identification_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_96C22258EBADDE6A ON teams (championship)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041E5C617D0 FOREIGN KEY (home_team) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041558F2381 FOREIGN KEY (away_team) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes ADD CONSTRAINT FK_11BA68C6ACE3B73 FOREIGN KEY (participation_id) REFERENCES participations (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations ADD CONSTRAINT FK_FDC6C6E898197A65 FOREIGN KEY (player) REFERENCES players (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations ADD CONSTRAINT FK_FDC6C6E87A5BC505 FOREIGN KEY (match) REFERENCES matchs (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations ADD CONSTRAINT FK_FDC6C6E8C4E0A61F FOREIGN KEY (team) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE players ADD CONSTRAINT FK_264E43A6C4E0A61F FOREIGN KEY (team) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teams ADD CONSTRAINT FK_96C22258EBADDE6A FOREIGN KEY (championship) REFERENCES championships (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE championships_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE matchs_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE notes_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE participations_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE players_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE teams_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs DROP CONSTRAINT FK_6B1E6041E5C617D0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs DROP CONSTRAINT FK_6B1E6041558F2381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notes DROP CONSTRAINT FK_11BA68C6ACE3B73
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations DROP CONSTRAINT FK_FDC6C6E898197A65
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations DROP CONSTRAINT FK_FDC6C6E87A5BC505
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participations DROP CONSTRAINT FK_FDC6C6E8C4E0A61F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE players DROP CONSTRAINT FK_264E43A6C4E0A61F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teams DROP CONSTRAINT FK_96C22258EBADDE6A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE championships
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE matchs
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE notes
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE participations
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE players
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE teams
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
