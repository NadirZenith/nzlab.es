<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161123002955 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nz__crawler_crawled (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, gallery_id INT DEFAULT NULL, date DATETIME NOT NULL, content LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, excerpt LONGTEXT NOT NULL, enabled TINYINT(1) NOT NULL, source VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6D02B2AD5F8A7F73 (source), INDEX IDX_6D02B2AD3DA5256D (image_id), INDEX IDX_6D02B2AD4E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nz__crawler_link (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, link_text VARCHAR(255) DEFAULT NULL, crawled_url VARCHAR(255) NOT NULL, processed TINYINT(1) NOT NULL, has_error TINYINT(1) NOT NULL, skip TINYINT(1) NOT NULL, note LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', items LONGTEXT DEFAULT NULL, crawled_at DATETIME NOT NULL, INDEX IDX_2DA0FAFFCCFA12B8 (profile_id), UNIQUE INDEX profile_link_idx (crawled_url, profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nz__crawler_profile (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, config LONGTEXT NOT NULL, processed TINYINT(1) NOT NULL, enabled TINYINT(1) NOT NULL, last_processed_at DATETIME DEFAULT NULL, last_processed_status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nz__crawler_crawled ADD CONSTRAINT FK_6D02B2AD3DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE nz__crawler_crawled ADD CONSTRAINT FK_6D02B2AD4E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE nz__crawler_link ADD CONSTRAINT FK_2DA0FAFFCCFA12B8 FOREIGN KEY (profile_id) REFERENCES nz__crawler_profile (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nz__crawler_link DROP FOREIGN KEY FK_2DA0FAFFCCFA12B8');
        $this->addSql('DROP TABLE nz__crawler_crawled');
        $this->addSql('DROP TABLE nz__crawler_link');
        $this->addSql('DROP TABLE nz__crawler_profile');
    }
}
