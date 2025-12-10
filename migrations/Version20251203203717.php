<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251203203717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE championships DROP identification_code
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs DROP identification_code
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE players DROP identification_code
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teams DROP identification_code
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE championships ADD identification_code VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE teams ADD identification_code VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE players ADD identification_code VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE matchs ADD identification_code VARCHAR(255) NOT NULL
        SQL);
    }
}
