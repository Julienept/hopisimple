<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612160735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5869545666');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58517FE9FE');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED588565851');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED589909C13F');
        $this->addSql('DROP TABLE bonus');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE establishment');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP INDEX UNIQ_77E0ED588565851 ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED5869545666 ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED58517FE9FE ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED589909C13F ON ad');
        $this->addSql('ALTER TABLE ad DROP equipment_id, DROP establishment_id, DROP transport_id, DROP bonus_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bonus (id INT AUTO_INCREMENT NOT NULL, gentle_household_product TINYINT(1) DEFAULT NULL, hospital_product TINYINT(1) DEFAULT NULL, earth_protection TINYINT(1) DEFAULT NULL, dedicated_space TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, washer TINYINT(1) NOT NULL, handwashing TINYINT(1) NOT NULL, tumble_dryer TINYINT(1) NOT NULL, air_drying TINYINT(1) NOT NULL, ironing TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE establishment (id INT AUTO_INCREMENT NOT NULL, at_home TINYINT(1) NOT NULL, at_laundry_service TINYINT(1) NOT NULL, at_friends_place TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, private TINYINT(1) NOT NULL, public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ad ADD equipment_id INT NOT NULL, ADD establishment_id INT NOT NULL, ADD transport_id INT NOT NULL, ADD bonus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5869545666 FOREIGN KEY (bonus_id) REFERENCES bonus (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED588565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED589909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED588565851 ON ad (establishment_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED5869545666 ON ad (bonus_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED58517FE9FE ON ad (equipment_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED589909C13F ON ad (transport_id)');
    }
}
