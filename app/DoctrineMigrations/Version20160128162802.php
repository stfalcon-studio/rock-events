<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160128162802 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE request_right (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, group_id INT DEFAULT NULL, text LONGTEXT NOT NULL, is_confirm TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E9DDC931A76ED395 (user_id), INDEX IDX_E9DDC931FE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE request_right ADD CONSTRAINT FK_E9DDC931A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE request_right ADD CONSTRAINT FK_E9DDC931FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE');
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

        $this->addSql('DROP TABLE request_right');
        $this->addSql('ALTER TABLE events CHANGE is_active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE genres CHANGE is_active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE groups CHANGE is_active active TINYINT(1) NOT NULL');
    }
}
