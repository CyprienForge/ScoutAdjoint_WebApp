<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250815175052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajoute la colonne id_txt à settings sans casser les données existantes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE settings ADD id_txt VARCHAR(255)
        SQL);

        $this->addSql(<<<'SQL'
            UPDATE settings SET id_txt = 'default_value'
        SQL);

        $this->addSql(<<<'SQL'
            ALTER TABLE settings ALTER COLUMN id_txt SET NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE settings DROP COLUMN id_txt
        SQL);
    }
}
