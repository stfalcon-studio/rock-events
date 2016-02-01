<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160130151416 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups_to_genres (id INT AUTO_INCREMENT NOT NULL, group_id INT NOT NULL, genre_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_98EE3434FE54D947 (group_id), INDEX IDX_98EE34344296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A8EBE516B03A8386 (created_by_id), INDEX IDX_A8EBE516896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_to_genres (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, genre_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E844936AA76ED395 (user_id), INDEX IDX_E844936A4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_to_groups (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B0C24F0CA76ED395 (user_id), INDEX IDX_B0C24F0CFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE managers_to_groups (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_48EA2A27783E3463 (manager_id), INDEX IDX_48EA2A27FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, country VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, address VARCHAR(255) DEFAULT NULL, begin_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, slug VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5387574AB03A8386 (created_by_id), INDEX IDX_5387574A896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_managers_to_groups (id INT AUTO_INCREMENT NOT NULL, request_manager_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5C781A1430C7F3D9 (request_manager_id), INDEX IDX_5C781A14FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_managers (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, surname VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, text LONGTEXT NOT NULL, status ENUM(\'sent\', \'processed\', \'accepted\', \'denied\') DEFAULT NULL COMMENT \'(DC2Type:RequestManagerStatusType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5C6C0023B03A8386 (created_by_id), INDEX IDX_5C6C0023896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, updated_by_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, founded_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F06D3970B03A8386 (created_by_id), INDEX IDX_F06D3970896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_54469DF4A76ED395 (user_id), INDEX IDX_54469DF471F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events_to_groups (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4F4B50CF71F7E88B (event_id), INDEX IDX_4F4B50CFFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groups_to_genres ADD CONSTRAINT FK_98EE3434FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groups_to_genres ADD CONSTRAINT FK_98EE34344296D31F FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users_to_genres ADD CONSTRAINT FK_E844936AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_genres ADD CONSTRAINT FK_E844936A4296D31F FOREIGN KEY (genre_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_groups ADD CONSTRAINT FK_B0C24F0CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_to_groups ADD CONSTRAINT FK_B0C24F0CFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE managers_to_groups ADD CONSTRAINT FK_48EA2A27783E3463 FOREIGN KEY (manager_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE managers_to_groups ADD CONSTRAINT FK_48EA2A27FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE request_managers_to_groups ADD CONSTRAINT FK_5C781A1430C7F3D9 FOREIGN KEY (request_manager_id) REFERENCES request_managers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request_managers_to_groups ADD CONSTRAINT FK_5C781A14FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request_managers ADD CONSTRAINT FK_5C6C0023B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE request_managers ADD CONSTRAINT FK_5C6C0023896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
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
        $this->addSql('ALTER TABLE request_managers_to_groups DROP FOREIGN KEY FK_5C781A1430C7F3D9');
        $this->addSql('ALTER TABLE groups_to_genres DROP FOREIGN KEY FK_98EE3434FE54D947');
        $this->addSql('ALTER TABLE users_to_groups DROP FOREIGN KEY FK_B0C24F0CFE54D947');
        $this->addSql('ALTER TABLE managers_to_groups DROP FOREIGN KEY FK_48EA2A27FE54D947');
        $this->addSql('ALTER TABLE request_managers_to_groups DROP FOREIGN KEY FK_5C781A14FE54D947');
        $this->addSql('ALTER TABLE events_to_groups DROP FOREIGN KEY FK_4F4B50CFFE54D947');
        $this->addSql('ALTER TABLE genres DROP FOREIGN KEY FK_A8EBE516B03A8386');
        $this->addSql('ALTER TABLE genres DROP FOREIGN KEY FK_A8EBE516896DBBDE');
        $this->addSql('ALTER TABLE users_to_genres DROP FOREIGN KEY FK_E844936AA76ED395');
        $this->addSql('ALTER TABLE users_to_groups DROP FOREIGN KEY FK_B0C24F0CA76ED395');
        $this->addSql('ALTER TABLE managers_to_groups DROP FOREIGN KEY FK_48EA2A27783E3463');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AB03A8386');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A896DBBDE');
        $this->addSql('ALTER TABLE request_managers DROP FOREIGN KEY FK_5C6C0023B03A8386');
        $this->addSql('ALTER TABLE request_managers DROP FOREIGN KEY FK_5C6C0023896DBBDE');
        $this->addSql('ALTER TABLE groups DROP FOREIGN KEY FK_F06D3970B03A8386');
        $this->addSql('ALTER TABLE groups DROP FOREIGN KEY FK_F06D3970896DBBDE');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4A76ED395');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE groups_to_genres');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE users_to_genres');
        $this->addSql('DROP TABLE users_to_groups');
        $this->addSql('DROP TABLE managers_to_groups');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE request_managers_to_groups');
        $this->addSql('DROP TABLE request_managers');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('DROP TABLE events_to_groups');
        $this->addSql('DROP TABLE users');
    }
}
