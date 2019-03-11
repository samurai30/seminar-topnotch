<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311094422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE featured (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scape_properties ADD featured_id INT NOT NULL, CHANGE prop_notes prop_notes VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE scape_properties ADD CONSTRAINT FK_DD8E1AB4306FF23 FOREIGN KEY (featured_id) REFERENCES featured (id)');
        $this->addSql('CREATE INDEX IDX_DD8E1AB4306FF23 ON scape_properties (featured_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE scape_properties DROP FOREIGN KEY FK_DD8E1AB4306FF23');
        $this->addSql('DROP TABLE featured');
        $this->addSql('DROP INDEX IDX_DD8E1AB4306FF23 ON scape_properties');
        $this->addSql('ALTER TABLE scape_properties DROP featured_id, CHANGE prop_notes prop_notes VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
