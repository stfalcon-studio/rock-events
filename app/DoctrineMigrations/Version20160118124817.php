<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160118124817 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE groups_to_genres (id INT AUTO_INCREMENT NOT NULL, group_id INT NOT NULL, genre_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_98EE3434FE54D947 (group_id), INDEX IDX_98EE34344296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A8EBE516B03A8386 (created_by_id), INDEX IDX_A8EBE516896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_to_genres (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, genre_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E844936AA76ED395 (user_id), INDEX IDX_E844936A4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_to_groups (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B0C24F0CA76ED395 (user_id), INDEX IDX_B0C24F0CFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, country VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, address VARCHAR(255) DEFAULT NULL, begin_at DATETIME DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, end_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5387574AB03A8386 (created_by_id), INDEX IDX_5387574A896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, founded_at INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F06D3970B03A8386 (created_by_id), INDEX IDX_F06D3970896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_54469DF4A76ED395 (user_id), INDEX IDX_54469DF471F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events_to_groups (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4F4B50CF71F7E88B (event_id), INDEX IDX_4F4B50CFFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groups_to_genres ADD CONSTRAINT FK_98EE3434FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groups_to_genres ADD CONSTRAINT FK_98EE34344296D31F FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_to_genres ADD CONSTRAINT FK_E844936AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_genres ADD CONSTRAINT FK_E844936A4296D31F FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_groups ADD CONSTRAINT FK_B0C24F0CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_groups ADD CONSTRAINT FK_B0C24F0CFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT FK_F06D3970B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT FK_F06D3970896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF471F7E88B FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events_to_groups ADD CONSTRAINT FK_4F4B50CF71F7E88B FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events_to_groups ADD CONSTRAINT FK_4F4B50CFFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groups_to_genres DROP FOREIGN KEY FK_98EE34344296D31F');
        $this->addSql('ALTER TABLE users_to_genres DROP FOREIGN KEY FK_E844936A4296D31F');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF471F7E88B');
        $this->addSql('ALTER TABLE events_to_groups DROP FOREIGN KEY FK_4F4B50CF71F7E88B');
        $this->addSql('ALTER TABLE groups_to_genres DROP FOREIGN KEY FK_98EE3434FE54D947');
        $this->addSql('ALTER TABLE users_to_groups DROP FOREIGN KEY FK_B0C24F0CFE54D947');
        $this->addSql('ALTER TABLE events_to_groups DROP FOREIGN KEY FK_4F4B50CFFE54D947');
        $this->addSql('DROP TABLE groups_to_genres');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE users_to_genres');
        $this->addSql('DROP TABLE users_to_groups');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('DROP TABLE events_to_groups');
    }
}
