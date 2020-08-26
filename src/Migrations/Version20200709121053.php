<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200709121053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, supercategorie_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_497DD6344854D920 (supercategorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, document_id INT NOT NULL, video_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, auteur VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, INDEX IDX_67F068BCC33F7837 (document_id), INDEX IDX_67F068BC29C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, contributeur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, taille DOUBLE PRECISION DEFAULT NULL, page INT DEFAULT NULL, langue VARCHAR(20) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_ajout TIME NOT NULL, nbr_telechargement INT DEFAULT NULL, nbr_like INT DEFAULT NULL, nbr_unlike INT DEFAULT NULL, INDEX IDX_D8698A76BCF5E72D (categorie_id), INDEX IDX_D8698A76B903F8C2 (contributeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, contributeur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, taille DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, date_ajout DATE NOT NULL, nbr_telechargement INT DEFAULT NULL, nbr_like INT DEFAULT NULL, nbr_unlike INT DEFAULT NULL, duree TIME NOT NULL, format VARCHAR(10) DEFAULT NULL, INDEX IDX_7CC7DA2CBCF5E72D (categorie_id), INDEX IDX_7CC7DA2CB903F8C2 (contributeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6344854D920 FOREIGN KEY (supercategorie_id) REFERENCES super_categorie (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC29C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76B903F8C2 FOREIGN KEY (contributeur_id) REFERENCES contributeur (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB903F8C2 FOREIGN KEY (contributeur_id) REFERENCES contributeur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76BCF5E72D');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBCF5E72D');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCC33F7837');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6344854D920');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC29C1004E');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE super_categorie');
        $this->addSql('DROP TABLE video');
    }
}
