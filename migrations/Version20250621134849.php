<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250621134849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE Player_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE Player (id INT NOT NULL, team_id INT DEFAULT NULL, firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, birthDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9FB57F53296CD8AE ON Player (team_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Player ADD CONSTRAINT FK_9FB57F53296CD8AE FOREIGN KEY (team_id) REFERENCES Team (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE Player_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Player DROP CONSTRAINT FK_9FB57F53296CD8AE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE Player
        SQL);
    }
}
