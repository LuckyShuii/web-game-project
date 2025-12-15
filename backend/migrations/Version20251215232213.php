<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215232213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `game_character` (id BINARY(16) NOT NULL, class VARCHAR(20) NOT NULL, race VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, player_id BINARY(16) NOT NULL, INDEX IDX_937AB03499E6F5DF (player_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE combat (id BINARY(16) NOT NULL, enemy_code VARCHAR(50) NOT NULL, status VARCHAR(20) NOT NULL, state JSON DEFAULT NULL, started_at DATETIME DEFAULT NULL, ended_at DATETIME DEFAULT NULL, character_id BINARY(16) NOT NULL, INDEX IDX_8D51E3981136BE75 (character_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE player (id BINARY(16) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `game_character` ADD CONSTRAINT FK_937AB03499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E3981136BE75 FOREIGN KEY (character_id) REFERENCES `game_character` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03499E6F5DF');
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E3981136BE75');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE player');
    }
}
