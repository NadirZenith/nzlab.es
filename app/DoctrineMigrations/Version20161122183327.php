<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161122183327 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timeline__timeline ADD action_id INT DEFAULT NULL, ADD subject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD59D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id)');
        $this->addSql('ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD523EDC87 FOREIGN KEY (subject_id) REFERENCES timeline__component (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_FFBC6AD59D32F035 ON timeline__timeline (action_id)');
        $this->addSql('CREATE INDEX IDX_FFBC6AD523EDC87 ON timeline__timeline (subject_id)');
        $this->addSql('ALTER TABLE timeline__action_component ADD action_id INT DEFAULT NULL, ADD component_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B169D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B16E2ABAFFF FOREIGN KEY (component_id) REFERENCES timeline__component (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6ACD1B169D32F035 ON timeline__action_component (action_id)');
        $this->addSql('CREATE INDEX IDX_6ACD1B16E2ABAFFF ON timeline__action_component (component_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B169D32F035');
        $this->addSql('ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B16E2ABAFFF');
        $this->addSql('DROP INDEX IDX_6ACD1B169D32F035 ON timeline__action_component');
        $this->addSql('DROP INDEX IDX_6ACD1B16E2ABAFFF ON timeline__action_component');
        $this->addSql('ALTER TABLE timeline__action_component DROP action_id, DROP component_id');
        $this->addSql('ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD59D32F035');
        $this->addSql('ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD523EDC87');
        $this->addSql('DROP INDEX IDX_FFBC6AD59D32F035 ON timeline__timeline');
        $this->addSql('DROP INDEX IDX_FFBC6AD523EDC87 ON timeline__timeline');
        $this->addSql('ALTER TABLE timeline__timeline DROP action_id, DROP subject_id');
    }
}
