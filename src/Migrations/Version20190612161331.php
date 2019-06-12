<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612161331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad ADD private_transport TINYINT(1) NOT NULL, ADD public_transport TINYINT(1) NOT NULL, ADD at_home TINYINT(1) NOT NULL, ADD at_laundry_service TINYINT(1) NOT NULL, ADD at_friends_place TINYINT(1) NOT NULL, ADD gentle_household_product TINYINT(1) DEFAULT NULL, ADD hospital_product TINYINT(1) DEFAULT NULL, ADD earth_protection TINYINT(1) DEFAULT NULL, ADD dedicated_place TINYINT(1) DEFAULT NULL, ADD washer TINYINT(1) NOT NULL, ADD handwashinhandwashing TINYINT(1) NOT NULL, ADD tumble_dryer TINYINT(1) NOT NULL, ADD air_drying TINYINT(1) NOT NULL, ADD ironing TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ad DROP private_transport, DROP public_transport, DROP at_home, DROP at_laundry_service, DROP at_friends_place, DROP gentle_household_product, DROP hospital_product, DROP earth_protection, DROP dedicated_place, DROP washer, DROP handwashinhandwashing, DROP tumble_dryer, DROP air_drying, DROP ironing');
    }
}
