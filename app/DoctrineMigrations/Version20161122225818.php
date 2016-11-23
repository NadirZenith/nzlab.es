<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161122225818 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nz__migration_log (id INT AUTO_INCREMENT NOT NULL, source_class VARCHAR(255) NOT NULL, source_class_id VARCHAR(255) NOT NULL, target_class VARCHAR(255) DEFAULT NULL, target_class_id VARCHAR(255) DEFAULT NULL, has_error TINYINT(1) NOT NULL, note LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX migration_log_idx (source_class, source_class_id, target_class, target_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE nz__migration_log');
    }
}
