<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250629114658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE Participation_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE Participation (id INT NOT NULL, player_id INT NOT NULL, match_id INT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_182BA9BA99E6F5DF ON Participation (player_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_182BA9BA2ABEACD6 ON Participation (match_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Participation ADD CONSTRAINT FK_182BA9BA99E6F5DF FOREIGN KEY (player_id) REFERENCES Player (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Participation ADD CONSTRAINT FK_182BA9BA2ABEACD6 FOREIGN KEY (match_id) REFERENCES Match (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE Participation_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Participation DROP CONSTRAINT FK_182BA9BA99E6F5DF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Participation DROP CONSTRAINT FK_182BA9BA2ABEACD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE Participation
        SQL);
    }
}
