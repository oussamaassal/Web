<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514224445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categ_terrain (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserver_terrain (id INT AUTO_INCREMENT NOT NULL, terrain VARCHAR(255) NOT NULL, nbp INT NOT NULL, date DATE NOT NULL, horaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article CHANGE IdJournaliste idjournaliste INT DEFAULT NULL, CHANGE Description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE article RENAME INDEX const TO IDX_23A0E66496176DB');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY billet_ibfk_1');
        $this->addSql('DROP INDEX Billet ON billet');
        $this->addSql('ALTER TABLE billet ADD idrencontre_id INT DEFAULT NULL, DROP IdRencontre');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF62A537711 FOREIGN KEY (idrencontre_id) REFERENCES rencontre (idrencontre)');
        $this->addSql('CREATE INDEX IDX_1F034AF62A537711 ON billet (idrencontre_id)');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY candidat_ibfk_1');
        $this->addSql('ALTER TABLE candidat CHANGE idElection idelection INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4717675700D FOREIGN KEY (idelection) REFERENCES evenement (ide)');
        $this->addSql('ALTER TABLE candidat RENAME INDEX idelection TO IDX_6AB5B4717675700D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('ALTER TABLE commande CHANGE idproduit idproduit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF6A1BE49 FOREIGN KEY (idproduit) REFERENCES produit (idproduit)');
        $this->addSql('ALTER TABLE commande RENAME INDEX commande_ibfk_1 TO IDX_6EEAA67DF6A1BE49');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY contrat_ibfk_1');
        $this->addSql('ALTER TABLE contrat CHANGE date_debut date_debut DATETIME NOT NULL, CHANGE date_fin date_fin DATETIME NOT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499938C03F15C FOREIGN KEY (employee_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE contrat RENAME INDEX employee_id TO IDX_603499938C03F15C');
        $this->addSql('ALTER TABLE evenement CHANGE dateE datee DATETIME NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD qrcode VARCHAR(255) NOT NULL, ADD shirtnum INT NOT NULL, CHANGE imagePath imagepath VARCHAR(255) NOT NULL, CHANGE Link link VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD category_id INT DEFAULT NULL, CHANGE PrixProduit prixproduit INT DEFAULT NULL, CHANGE TailleProduit tailleproduit VARCHAR(255) DEFAULT NULL, CHANGE Type type VARCHAR(255) DEFAULT NULL, CHANGE QauntiteProduit qauntiteproduit INT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2712469DE2 ON produit (category_id)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY reclamation_ibfk_1');
        $this->addSql('ALTER TABLE reclamation CHANGE IdUser iduser INT DEFAULT NULL, CHANGE Description description VARCHAR(255) NOT NULL, CHANGE Etat etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064045E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE reclamation RENAME INDEX reclamation_ibfk_1 TO IDX_CE6064045E5C27E9');
        $this->addSql('ALTER TABLE rencontre CHANGE DateRencontre daterencontre DATETIME NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_1');
        $this->addSql('DROP INDEX Choixterrain ON reservation');
        $this->addSql('ALTER TABLE reservation DROP idTerrain, CHANGE DateReservation datereservation VARCHAR(255) NOT NULL, CHANGE Note note VARCHAR(255) NOT NULL, CHANGE Emplacement emplacement VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE terrain ADD categ_terrain_id INT DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE geo_x geo_x DOUBLE PRECISION NOT NULL, CHANGE geo_y geo_y DOUBLE PRECISION NOT NULL, CHANGE ouverture ouverture DATETIME NOT NULL, CHANGE fermeture fermeture DATETIME NOT NULL, CHANGE datedispo datedispo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE terrain ADD CONSTRAINT FK_C87653B139C3F66A FOREIGN KEY (categ_terrain_id) REFERENCES categ_terrain (id)');
        $this->addSql('CREATE INDEX IDX_C87653B139C3F66A ON terrain (categ_terrain_id)');
        $this->addSql('ALTER TABLE user ADD image VARCHAR(255) NOT NULL, ADD qr_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vote ADD idUser INT NOT NULL, CHANGE idCandidatV idCandidatV INT DEFAULT NULL, CHANGE idElectionV idElectionV INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A1085648B88C404 FOREIGN KEY (idCandidatV) REFERENCES candidat (idc)');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT FK_5A108564AC3C9022 FOREIGN KEY (idElectionV) REFERENCES evenement (ide)');
        $this->addSql('ALTER TABLE vote RENAME INDEX idcandidatv TO IDX_5A1085648B88C404');
        $this->addSql('ALTER TABLE vote RENAME INDEX idelectionv TO IDX_5A108564AC3C9022');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE terrain DROP FOREIGN KEY FK_C87653B139C3F66A');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2712469DE2');
        $this->addSql('DROP TABLE categ_terrain');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE reserver_terrain');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX IDX_C87653B139C3F66A ON terrain');
        $this->addSql('ALTER TABLE terrain DROP categ_terrain_id, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE geo_x geo_x DOUBLE PRECISION DEFAULT NULL, CHANGE geo_y geo_y DOUBLE PRECISION DEFAULT NULL, CHANGE ouverture ouverture TIME DEFAULT NULL, CHANGE fermeture fermeture TIME DEFAULT NULL, CHANGE datedispo datedispo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE idjournaliste IdJournaliste INT NOT NULL, CHANGE description Description VARCHAR(1100) NOT NULL');
        $this->addSql('ALTER TABLE article RENAME INDEX idx_23a0e66496176db TO const');
        $this->addSql('ALTER TABLE rencontre CHANGE daterencontre DateRencontre DATE NOT NULL');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF62A537711');
        $this->addSql('DROP INDEX IDX_1F034AF62A537711 ON billet');
        $this->addSql('ALTER TABLE billet ADD IdRencontre INT NOT NULL, DROP idrencontre_id');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT billet_ibfk_1 FOREIGN KEY (IdRencontre) REFERENCES rencontre (IdRencontre) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX Billet ON billet (IdRencontre)');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A1085648B88C404');
        $this->addSql('ALTER TABLE vote DROP FOREIGN KEY FK_5A108564AC3C9022');
        $this->addSql('ALTER TABLE vote DROP idUser, CHANGE idCandidatV idCandidatV INT NOT NULL, CHANGE idElectionV idElectionV INT NOT NULL');
        $this->addSql('ALTER TABLE vote RENAME INDEX idx_5a1085648b88c404 TO idCandidatV');
        $this->addSql('ALTER TABLE vote RENAME INDEX idx_5a108564ac3c9022 TO idElectionV');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4717675700D');
        $this->addSql('ALTER TABLE candidat CHANGE idelection idElection INT NOT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT candidat_ibfk_1 FOREIGN KEY (idElection) REFERENCES evenement (idE) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidat RENAME INDEX idx_6ab5b4717675700d TO idElection');
        $this->addSql('ALTER TABLE joueur DROP qrcode, DROP shirtnum, CHANGE imagepath imagePath VARCHAR(255) DEFAULT NULL, CHANGE link Link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064045E5C27E9');
        $this->addSql('ALTER TABLE reclamation CHANGE iduser IdUser INT NOT NULL, CHANGE description Description VARCHAR(1000) NOT NULL, CHANGE etat Etat INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT reclamation_ibfk_1 FOREIGN KEY (IdUser) REFERENCES user (idUser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation RENAME INDEX idx_ce6064045e5c27e9 TO reclamation_ibfk_1');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF6A1BE49');
        $this->addSql('ALTER TABLE commande CHANGE idproduit idproduit INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (idproduit) REFERENCES produit (IdProduit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande RENAME INDEX idx_6eeaa67df6a1be49 TO commande_ibfk_1');
        $this->addSql('ALTER TABLE user DROP image, DROP qr_code');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499938C03F15C');
        $this->addSql('ALTER TABLE contrat CHANGE date_debut date_debut DATE DEFAULT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT contrat_ibfk_1 FOREIGN KEY (employee_id) REFERENCES joueur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contrat RENAME INDEX idx_603499938c03f15c TO employee_id');
        $this->addSql('ALTER TABLE reservation ADD idTerrain INT DEFAULT NULL, CHANGE datereservation DateReservation VARCHAR(255) DEFAULT NULL, CHANGE note Note VARCHAR(255) DEFAULT NULL, CHANGE emplacement Emplacement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_1 FOREIGN KEY (idTerrain) REFERENCES terrain (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX Choixterrain ON reservation (idTerrain)');
        $this->addSql('DROP INDEX IDX_29A5EC2712469DE2 ON produit');
        $this->addSql('ALTER TABLE produit DROP category_id, CHANGE prixproduit PrixProduit INT NOT NULL, CHANGE tailleproduit TailleProduit VARCHAR(5) NOT NULL, CHANGE type Type VARCHAR(255) NOT NULL, CHANGE qauntiteproduit QauntiteProduit INT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE datee dateE DATE NOT NULL');
    }
}
