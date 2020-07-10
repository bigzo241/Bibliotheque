<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709113715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, auteur VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, taille DOUBLE PRECISION DEFAULT NULL, page INT DEFAULT NULL, langue VARCHAR(20) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_ajout TIME NOT NULL, nbr_telechargement INT DEFAULT NULL, nbr_like INT DEFAULT NULL, nbr_unlike INT DEFAULT NULL, INDEX IDX_D8698A76BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, taille DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, date_ajout DATE NOT NULL, nbr_telechargement INT DEFAULT NULL, nbr_like INT DEFAULT NULL, nbr_unlike INT DEFAULT NULL, duree TIME NOT NULL, format VARCHAR(10) DEFAULT NULL, INDEX IDX_7CC7DA2CBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76BCF5E72D');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE super_categorie');
        $this->addSql('DROP TABLE video');
    }
}
