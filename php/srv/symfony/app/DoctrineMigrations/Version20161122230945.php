<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161122230945 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nz__cron_job (id INT AUTO_INCREMENT NOT NULL, command VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, job_interval VARCHAR(40) NOT NULL, nextRun DATETIME NOT NULL, enabled TINYINT(1) NOT NULL, mostRecentRun_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_2E0B148B14691BE8 (mostRecentRun_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nz__cron_job_result (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, runAt DATETIME NOT NULL, runTime DOUBLE PRECISION NOT NULL, result INT NOT NULL, output LONGTEXT NOT NULL, INDEX IDX_CF323109BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nz__cron_job ADD CONSTRAINT FK_2E0B148B14691BE8 FOREIGN KEY (mostRecentRun_id) REFERENCES nz__cron_job_result (id)');
        $this->addSql('ALTER TABLE nz__cron_job_result ADD CONSTRAINT FK_CF323109BE04EA9 FOREIGN KEY (job_id) REFERENCES nz__cron_job (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nz__cron_job_result DROP FOREIGN KEY FK_CF323109BE04EA9');
        $this->addSql('ALTER TABLE nz__cron_job DROP FOREIGN KEY FK_2E0B148B14691BE8');
        $this->addSql('DROP TABLE nz__cron_job');
        $this->addSql('DROP TABLE nz__cron_job_result');
    }
}
