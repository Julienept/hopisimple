<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190618115237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, street_number DOUBLE PRECISION NOT NULL, street_name VARCHAR(255) NOT NULL, address_supplement LONGTEXT DEFAULT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, latitude NUMERIC(18, 8) DEFAULT NULL, longitude NUMERIC(18, 8) DEFAULT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment (id INT AUTO_INCREMENT NOT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, city VARCHAR(255) NOT NULL, INDEX IDX_77E0ED58A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ad_tag (ad_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_717EDDB44F34D596 (ad_id), INDEX IDX_717EDDB4BAD26311 (tag_id), PRIMARY KEY(ad_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, place_id INT NOT NULL, title VARCHAR(10) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, inscription_date DATETIME NOT NULL, rating DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8D93D649DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, washing VARCHAR(255) NOT NULL, drying VARCHAR(255) NOT NULL, ironing TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bonus (id INT AUTO_INCREMENT NOT NULL, product_type VARCHAR(255) DEFAULT NULL, earth_protection TINYINT(1) DEFAULT NULL, dedicated_space TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ad_tag ADD CONSTRAINT FK_717EDDB44F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ad_tag ADD CONSTRAINT FK_717EDDB4BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DA6A219');
        $this->addSql('ALTER TABLE ad_tag DROP FOREIGN KEY FK_717EDDB4BAD26311');
        $this->addSql('ALTER TABLE ad_tag DROP FOREIGN KEY FK_717EDDB44F34D596');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58A76ED395');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE establishment');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE ad_tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE bonus');
        $this->addSql('DROP TABLE transport');
    }
}
