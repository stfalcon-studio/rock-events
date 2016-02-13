<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160204165907 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE request_managers DROP FOREIGN KEY FK_5C6C0023A76ED395');
        $this->addSql('DROP INDEX IDX_5C6C0023A76ED395 ON request_managers');
        $this->addSql('ALTER TABLE request_managers CHANGE user_id requested_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE request_managers ADD CONSTRAINT FK_5C6C00234DA1E751 FOREIGN KEY (requested_by_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5C6C00234DA1E751 ON request_managers (requested_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE request_managers DROP FOREIGN KEY FK_5C6C00234DA1E751');
        $this->addSql('DROP INDEX IDX_5C6C00234DA1E751 ON request_managers');
        $this->addSql('ALTER TABLE request_managers CHANGE requested_by_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE request_managers ADD CONSTRAINT FK_5C6C0023A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5C6C0023A76ED395 ON request_managers (user_id)');
    }
}
