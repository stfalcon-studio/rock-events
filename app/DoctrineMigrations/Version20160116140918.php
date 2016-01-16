<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160116140918 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A8EBE516B03A8386 (created_by_id), INDEX IDX_A8EBE516896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE groups ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT FK_F06D3970B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT FK_F06D3970896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_F06D3970B03A8386 ON groups (created_by_id)');
        $this->addSql('CREATE INDEX IDX_F06D3970896DBBDE ON groups (updated_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE genres');
        $this->addSql('ALTER TABLE groups DROP FOREIGN KEY FK_F06D3970B03A8386');
        $this->addSql('ALTER TABLE groups DROP FOREIGN KEY FK_F06D3970896DBBDE');
        $this->addSql('DROP INDEX IDX_F06D3970B03A8386 ON groups');
        $this->addSql('DROP INDEX IDX_F06D3970896DBBDE ON groups');
        $this->addSql('ALTER TABLE groups DROP created_by_id, DROP updated_by_id');
    }
}
