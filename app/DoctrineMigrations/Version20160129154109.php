<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160129154109 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE request_managers_to_groups (id INT AUTO_INCREMENT NOT NULL, request_manager_id INT NOT NULL, group_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5C781A1430C7F3D9 (request_manager_id), INDEX IDX_5C781A14FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_managers (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, surname VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, text LONGTEXT NOT NULL, status ENUM(\'sended\', \'processed\', \'accepted\', \'denied\') DEFAULT NULL COMMENT \'(DC2Type:RequestManagerStatusType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5C6C0023A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE request_managers_to_groups ADD CONSTRAINT FK_5C781A1430C7F3D9 FOREIGN KEY (request_manager_id) REFERENCES request_managers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request_managers_to_groups ADD CONSTRAINT FK_5C781A14FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request_managers ADD CONSTRAINT FK_5C6C0023A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genres CHANGE active is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE events CHANGE active is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE groups CHANGE active is_active TINYINT(1) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE request_managers_to_groups DROP FOREIGN KEY FK_5C781A1430C7F3D9');
        $this->addSql('DROP TABLE request_managers_to_groups');
        $this->addSql('DROP TABLE request_managers');
        $this->addSql('ALTER TABLE events CHANGE is_active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE genres CHANGE is_active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE groups CHANGE is_active active TINYINT(1) NOT NULL');
    }
}
