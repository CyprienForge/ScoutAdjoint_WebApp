<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250829211539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER pre_match_info TYPE VARCHAR(2000)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER post_match_info TYPE VARCHAR(2000)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER home_team_info TYPE VARCHAR(2000)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER away_team_info TYPE VARCHAR(2000)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER pre_match_info TYPE VARCHAR(255)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER post_match_info TYPE VARCHAR(255)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER home_team_info TYPE VARCHAR(255)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE match_infos ALTER away_team_info TYPE VARCHAR(255)
        SQL);
    }
}
