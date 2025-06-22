<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250617204155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE Team_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE Team (id INT NOT NULL, championship_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, logoPath VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_64D2092194DDBCE9 ON Team (championship_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Team ADD CONSTRAINT FK_64D2092194DDBCE9 FOREIGN KEY (championship_id) REFERENCES Championship (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE Team_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE Team DROP CONSTRAINT FK_64D2092194DDBCE9
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE Team
        SQL);
    }
}
