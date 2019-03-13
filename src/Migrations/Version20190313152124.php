<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190313152124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE scape_user ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE scape_user ADD CONSTRAINT FK_259E5424F5B7AF75 FOREIGN KEY (address_id) REFERENCES scape_user_address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_259E5424550872C ON scape_user (user_email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_259E5424F85E0677 ON scape_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_259E5424F5B7AF75 ON scape_user (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE scape_user DROP FOREIGN KEY FK_259E5424F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_259E5424550872C ON scape_user');
        $this->addSql('DROP INDEX UNIQ_259E5424F85E0677 ON scape_user');
        $this->addSql('DROP INDEX UNIQ_259E5424F5B7AF75 ON scape_user');
        $this->addSql('ALTER TABLE scape_user DROP address_id');
    }
}
