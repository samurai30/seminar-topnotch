<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190324141049 extends AbstractMigration
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
        $this->addSql('CREATE TABLE property_address (id INT AUTO_INCREMENT NOT NULL, prop_district VARCHAR(50) NOT NULL, prop_taluka VARCHAR(40) NOT NULL, prop_city VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_details (id INT AUTO_INCREMENT NOT NULL, prop_price INT NOT NULL, prop_bhk VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sacpe_user (id INT AUTO_INCREMENT NOT NULL, token VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scape_properties (id INT AUTO_INCREMENT NOT NULL, property_address_id INT NOT NULL, category_id INT NOT NULL, featured_id INT NOT NULL, prop_name VARCHAR(100) NOT NULL, prop_notes VARCHAR(100) DEFAULT NULL, prop_status VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_DD8E1AB440168F46 (property_address_id), INDEX IDX_DD8E1AB412469DE2 (category_id), INDEX IDX_DD8E1AB4306FF23 (featured_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scape_user (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, user_first_name VARCHAR(100) NOT NULL, user_last_name VARCHAR(100) NOT NULL, user_email VARCHAR(120) NOT NULL, user_contact VARCHAR(12) NOT NULL, username VARCHAR(60) NOT NULL, password VARCHAR(100) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', UNIQUE INDEX UNIQ_259E5424550872C (user_email), UNIQUE INDEX UNIQ_259E5424F85E0677 (username), UNIQUE INDEX UNIQ_259E5424F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scape_user_address (id INT AUTO_INCREMENT NOT NULL, pincode VARCHAR(6) NOT NULL, city VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scape_properties ADD CONSTRAINT FK_DD8E1AB440168F46 FOREIGN KEY (property_address_id) REFERENCES property_address (id)');
        $this->addSql('ALTER TABLE scape_properties ADD CONSTRAINT FK_DD8E1AB412469DE2 FOREIGN KEY (category_id) REFERENCES property_category (id)');
        $this->addSql('ALTER TABLE scape_properties ADD CONSTRAINT FK_DD8E1AB4306FF23 FOREIGN KEY (featured_id) REFERENCES featured (id)');
        $this->addSql('ALTER TABLE scape_user ADD CONSTRAINT FK_259E5424F5B7AF75 FOREIGN KEY (address_id) REFERENCES scape_user_address (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE scape_properties DROP FOREIGN KEY FK_DD8E1AB4306FF23');
        $this->addSql('ALTER TABLE scape_properties DROP FOREIGN KEY FK_DD8E1AB440168F46');
        $this->addSql('ALTER TABLE scape_properties DROP FOREIGN KEY FK_DD8E1AB412469DE2');
        $this->addSql('ALTER TABLE scape_user DROP FOREIGN KEY FK_259E5424F5B7AF75');
        $this->addSql('DROP TABLE featured');
        $this->addSql('DROP TABLE property_address');
        $this->addSql('DROP TABLE property_category');
        $this->addSql('DROP TABLE property_details');
        $this->addSql('DROP TABLE sacpe_user');
        $this->addSql('DROP TABLE scape_properties');
        $this->addSql('DROP TABLE scape_user');
        $this->addSql('DROP TABLE scape_user_address');
    }
}
