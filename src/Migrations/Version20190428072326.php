<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428072326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, scape_user_id INT NOT NULL, sacpe_vendor_id INT NOT NULL, scape_property_id INT NOT NULL, app_status VARCHAR(12) NOT NULL, app_date DATETIME DEFAULT NULL, app_time TIME DEFAULT NULL, INDEX IDX_FE38F84490650D3A (scape_user_id), INDEX IDX_FE38F8443FC5F76B (sacpe_vendor_id), INDEX IDX_FE38F8449DC47E41 (scape_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84490650D3A FOREIGN KEY (scape_user_id) REFERENCES scape_user (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8443FC5F76B FOREIGN KEY (sacpe_vendor_id) REFERENCES scape_user (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8449DC47E41 FOREIGN KEY (scape_property_id) REFERENCES scape_properties (id)');
        $this->addSql('ALTER TABLE scape_properties CHANGE featured_id featured_id INT DEFAULT NULL, CHANGE prop_notes prop_notes VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE scape_user CHANGE token token VARCHAR(40) DEFAULT NULL, CHANGE profile_pic_path profile_pic_path VARCHAR(60) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE appointment');
        $this->addSql('ALTER TABLE scape_properties CHANGE featured_id featured_id INT DEFAULT NULL, CHANGE prop_notes prop_notes VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE scape_user CHANGE token token VARCHAR(40) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE profile_pic_path profile_pic_path VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
