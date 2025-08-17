<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250816162400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP CONSTRAINT fk_fcfe397999e6f5df
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP CONSTRAINT fk_fcfe3979dd842e46
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_fcfe3979dd842e46
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_fcfe397999e6f5df
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD player INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD position INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP player_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP position_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD CONSTRAINT FK_FCFE397998197A65 FOREIGN KEY (player) REFERENCES players (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD CONSTRAINT FK_FCFE3979462CE4F5 FOREIGN KEY (position) REFERENCES positions (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCFE397998197A65 ON placements (player)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCFE3979462CE4F5 ON placements (position)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP CONSTRAINT FK_FCFE397998197A65
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP CONSTRAINT FK_FCFE3979462CE4F5
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FCFE397998197A65
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FCFE3979462CE4F5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD player_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD position_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP player
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements DROP position
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD CONSTRAINT fk_fcfe397999e6f5df FOREIGN KEY (player_id) REFERENCES players (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE placements ADD CONSTRAINT fk_fcfe3979dd842e46 FOREIGN KEY (position_id) REFERENCES positions (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_fcfe3979dd842e46 ON placements (position_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_fcfe397999e6f5df ON placements (player_id)
        SQL);
    }
}
