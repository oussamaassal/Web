<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417011939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categ_terrain (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY const');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY billet_ibfk_1');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY candidat_ibfk_1');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY contrat_ibfk_1');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('DROP TABLE annexe');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_1');
        $this->addSql('DROP INDEX Choixterrain ON reservation');
        $this->addSql('ALTER TABLE reservation DROP idTerrain, CHANGE DateReservation datereservation VARCHAR(255) NOT NULL, CHANGE Note note VARCHAR(255) NOT NULL, CHANGE Emplacement emplacement VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE terrain ADD categ_terrain_id INT DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE geo_x geo_x DOUBLE PRECISION NOT NULL, CHANGE geo_y geo_y DOUBLE PRECISION NOT NULL, CHANGE ouverture ouverture DATETIME NOT NULL, CHANGE fermeture fermeture DATETIME NOT NULL, CHANGE datedispo datedispo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE terrain ADD CONSTRAINT FK_C87653B139C3F66A FOREIGN KEY (categ_terrain_id) REFERENCES categ_terrain (id)');
        $this->addSql('CREATE INDEX IDX_C87653B139C3F66A ON terrain (categ_terrain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE terrain DROP FOREIGN KEY FK_C87653B139C3F66A');
        $this->addSql('CREATE TABLE annexe (IdAnnexe INT AUTO_INCREMENT NOT NULL, NomAnnexe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Localisation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(IdAnnexe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE article (IdArticle INT AUTO_INCREMENT NOT NULL, IdJournaliste INT NOT NULL, Titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Description VARCHAR(1100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX const (IdJournaliste), PRIMARY KEY(IdArticle)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE billet (IdBillet INT AUTO_INCREMENT NOT NULL, IdRencontre INT NOT NULL, PrixBillet INT NOT NULL, INDEX Billet (IdRencontre), PRIMARY KEY(IdBillet)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidat (idC INT AUTO_INCREMENT NOT NULL, nomC VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenomC VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, ageC INT NOT NULL, imgCpath VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idElection INT NOT NULL, INDEX idElection (idElection), PRIMARY KEY(idC)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (idproduit INT NOT NULL, IdCommande INT AUTO_INCREMENT NOT NULL, IdUser INT NOT NULL, Somme INT NOT NULL, quantite INT NOT NULL, INDEX commande_ibfk_1 (idproduit), PRIMARY KEY(IdCommande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contrat (contrat_id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, Salaire INT NOT NULL, INDEX employee_id (employee_id), PRIMARY KEY(contrat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenement (idE INT AUTO_INCREMENT NOT NULL, nomE VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, dateE DATE NOT NULL, posteE VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, periodeP VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, imgEpath VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idE)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, Nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Age INT NOT NULL, Position VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Hauteur INT NOT NULL, Poids INT NOT NULL, Piedfort VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, imagePath VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, Link VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (IdProduit INT AUTO_INCREMENT NOT NULL, NomProduit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PrixProduit INT NOT NULL, TailleProduit VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, QauntiteProduit INT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(IdProduit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (IdReclamation INT AUTO_INCREMENT NOT NULL, IdUser INT NOT NULL, Titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Description VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Etat INT NOT NULL, INDEX reclamation_ibfk_1 (IdUser), PRIMARY KEY(IdReclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rencontre (IdRencontre INT AUTO_INCREMENT NOT NULL, DateRebcontre DATE NOT NULL, Adversaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Score VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(IdRencontre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (idUser INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, motdepasse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, numtel INT NOT NULL, PRIMARY KEY(idUser)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vote (idV INT AUTO_INCREMENT NOT NULL, idCandidatV INT NOT NULL, idElectionV INT NOT NULL, INDEX idCandidatV (idCandidatV), INDEX idElectionV (idElectionV), PRIMARY KEY(idV)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT const FOREIGN KEY (IdJournaliste) REFERENCES user (idUser)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT billet_ibfk_1 FOREIGN KEY (IdRencontre) REFERENCES rencontre (IdRencontre) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT candidat_ibfk_1 FOREIGN KEY (idElection) REFERENCES evenement (idE) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (idproduit) REFERENCES produit (IdProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT contrat_ibfk_1 FOREIGN KEY (employee_id) REFERENCES joueur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (IdUser) REFERENCES user (idUser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE categ_terrain');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE reservation ADD idTerrain INT DEFAULT NULL, CHANGE datereservation DateReservation VARCHAR(255) DEFAULT NULL, CHANGE note Note VARCHAR(255) DEFAULT NULL, CHANGE emplacement Emplacement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_1 FOREIGN KEY (idTerrain) REFERENCES terrain (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX Choixterrain ON reservation (idTerrain)');
        $this->addSql('DROP INDEX IDX_C87653B139C3F66A ON terrain');
        $this->addSql('ALTER TABLE terrain DROP categ_terrain_id, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE geo_x geo_x DOUBLE PRECISION DEFAULT NULL, CHANGE geo_y geo_y DOUBLE PRECISION DEFAULT NULL, CHANGE ouverture ouverture TIME DEFAULT NULL, CHANGE fermeture fermeture TIME DEFAULT NULL, CHANGE datedispo datedispo VARCHAR(255) DEFAULT NULL');
    }
}
