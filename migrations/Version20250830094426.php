<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250830094426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE stadiums_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stadiums (id INT NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, matchDoctrine_id INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FD8B970EA5AED08C ON stadiums (matchDoctrine_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stadiums ADD CONSTRAINT FK_FD8B970EA5AED08C FOREIGN KEY (matchDoctrine_id) REFERENCES matchs (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE stadiums_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stadiums DROP CONSTRAINT FK_FD8B970EA5AED08C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stadiums
        SQL);
    }
}
