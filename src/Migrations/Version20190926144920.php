<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926144920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE FicheFrais DROP FOREIGN KEY FicheFrais_ibfk_1');
        $this->addSql('ALTER TABLE LigneFraisForfait DROP FOREIGN KEY LigneFraisForfait_ibfk_1');
        $this->addSql('ALTER TABLE LigneFraisHorsForfait DROP FOREIGN KEY LigneFraisHorsForfait_ibfk_1');
        $this->addSql('ALTER TABLE LigneFraisForfait DROP FOREIGN KEY LigneFraisForfait_ibfk_2');
        $this->addSql('ALTER TABLE FicheFrais DROP FOREIGN KEY FicheFrais_ibfk_2');
        $this->addSql('DROP TABLE Etat');
        $this->addSql('DROP TABLE FicheFrais');
        $this->addSql('DROP TABLE FraisForfait');
        $this->addSql('DROP TABLE LigneFraisForfait');
        $this->addSql('DROP TABLE LigneFraisHorsForfait');
        $this->addSql('DROP TABLE Visiteur');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Etat (id CHAR(2) NOT NULL COLLATE utf8mb4_general_ci, libelle VARCHAR(30) DEFAULT NULL COLLATE utf8mb4_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE FicheFrais (mois CHAR(6) NOT NULL COLLATE utf8mb4_general_ci, idVisiteur CHAR(4) NOT NULL COLLATE utf8mb4_general_ci, nbJustificatifs INT DEFAULT NULL, montantValide NUMERIC(10, 2) DEFAULT NULL, dateModif DATE DEFAULT NULL, idEtat CHAR(2) DEFAULT \'CR\' COLLATE utf8mb4_general_ci, INDEX idEtat (idEtat), INDEX IDX_1C4987DC1D06ADE3 (idVisiteur), PRIMARY KEY(idVisiteur, mois)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE FraisForfait (id CHAR(3) NOT NULL COLLATE utf8mb4_general_ci, libelle CHAR(20) DEFAULT NULL COLLATE utf8mb4_general_ci, montant NUMERIC(5, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE LigneFraisForfait (mois CHAR(6) NOT NULL COLLATE utf8mb4_general_ci, idVisiteur CHAR(4) NOT NULL COLLATE utf8mb4_general_ci, idFraisForfait CHAR(3) NOT NULL COLLATE utf8mb4_general_ci, quantite INT DEFAULT NULL, INDEX idFraisForfait (idFraisForfait), INDEX IDX_146093DC1D06ADE3D6B08CB7 (idVisiteur, mois), PRIMARY KEY(idVisiteur, mois, idFraisForfait)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE LigneFraisHorsForfait (id INT AUTO_INCREMENT NOT NULL, mois CHAR(6) NOT NULL COLLATE utf8mb4_general_ci, idVisiteur CHAR(4) NOT NULL COLLATE utf8mb4_general_ci, libelle VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_general_ci, date DATE DEFAULT NULL, montant NUMERIC(10, 2) DEFAULT NULL, INDEX idVisiteur (idVisiteur, mois), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Visiteur (id CHAR(4) NOT NULL COLLATE utf8mb4_general_ci, nom CHAR(30) DEFAULT NULL COLLATE utf8mb4_general_ci, prenom CHAR(30) DEFAULT NULL COLLATE utf8mb4_general_ci, login CHAR(20) DEFAULT NULL COLLATE utf8mb4_general_ci, mdp CHAR(20) DEFAULT NULL COLLATE utf8mb4_general_ci, adresse CHAR(30) DEFAULT NULL COLLATE utf8mb4_general_ci, cp CHAR(5) DEFAULT NULL COLLATE utf8mb4_general_ci, ville CHAR(30) DEFAULT NULL COLLATE utf8mb4_general_ci, dateEmbauche DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE FicheFrais ADD CONSTRAINT FicheFrais_ibfk_1 FOREIGN KEY (idEtat) REFERENCES Etat (id)');
        $this->addSql('ALTER TABLE FicheFrais ADD CONSTRAINT FicheFrais_ibfk_2 FOREIGN KEY (idVisiteur) REFERENCES Visiteur (id)');
        $this->addSql('ALTER TABLE LigneFraisForfait ADD CONSTRAINT LigneFraisForfait_ibfk_1 FOREIGN KEY (idVisiteur, mois) REFERENCES FicheFrais (idVisiteur, mois)');
        $this->addSql('ALTER TABLE LigneFraisForfait ADD CONSTRAINT LigneFraisForfait_ibfk_2 FOREIGN KEY (idFraisForfait) REFERENCES FraisForfait (id)');
        $this->addSql('ALTER TABLE LigneFraisHorsForfait ADD CONSTRAINT LigneFraisHorsForfait_ibfk_1 FOREIGN KEY (idVisiteur, mois) REFERENCES FicheFrais (idVisiteur, mois)');
    }
}
