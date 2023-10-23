<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023095258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, car_offer_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, is_main TINYINT(1) NOT NULL, INDEX IDX_C53D045FDCF041EA (car_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE open (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(32) NOT NULL, am_opening SMALLINT NOT NULL, am_closure SMALLINT NOT NULL, pm_opening SMALLINT NOT NULL, pm_closure SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(32) NOT NULL, last_name VARCHAR(32) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(32) DEFAULT NULL, role VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FDCF041EA FOREIGN KEY (car_offer_id) REFERENCES car_offer (id)');
        $this->addSql('DROP TABLE opening');
        $this->addSql('ALTER TABLE car_offer DROP photo');
        $this->addSql('ALTER TABLE review ADD is_approved TINYINT(1) DEFAULT 0 NOT NULL, DROP name, DROP approved, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opening (id INT AUTO_INCREMENT NOT NULL, hours LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FDCF041EA');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE open');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE car_offer ADD photo LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE review ADD name VARCHAR(32) NOT NULL, ADD approved TINYINT(1) NOT NULL, DROP is_approved, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
