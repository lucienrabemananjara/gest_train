<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808115850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE itineraire (id INT AUTO_INCREMENT NOT NULL, num_itineraire VARCHAR(255) NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrivee VARCHAR(255) NOT NULL, frais INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, trains_id INT DEFAULT NULL, num_place VARCHAR(255) NOT NULL, occupation TINYINT(1) NOT NULL, INDEX IDX_741D53CD6181D325 (trains_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, trains_id INT DEFAULT NULL, places_id INT DEFAULT NULL, num_reservation VARCHAR(255) NOT NULL, nom_voyageur VARCHAR(255) NOT NULL, date_reservation DATE NOT NULL, INDEX IDX_42C849556181D325 (trains_id), INDEX IDX_42C849558317B347 (places_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE train (id INT AUTO_INCREMENT NOT NULL, itineraires_id INT DEFAULT NULL, num_train VARCHAR(255) NOT NULL, design_train VARCHAR(255) NOT NULL, nbr_place INT NOT NULL, INDEX IDX_5C66E4A322623EC8 (itineraires_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD6181D325 FOREIGN KEY (trains_id) REFERENCES train (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556181D325 FOREIGN KEY (trains_id) REFERENCES train (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558317B347 FOREIGN KEY (places_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE train ADD CONSTRAINT FK_5C66E4A322623EC8 FOREIGN KEY (itineraires_id) REFERENCES itineraire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE train DROP FOREIGN KEY FK_5C66E4A322623EC8');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558317B347');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD6181D325');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556181D325');
        $this->addSql('DROP TABLE itineraire');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE train');
        $this->addSql('DROP TABLE utilisateur');
    }
}
