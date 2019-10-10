<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003142513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE frais_forfait (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_frais_hors_forfait (id INT AUTO_INCREMENT NOT NULL, id_visiteur_id INT NOT NULL, mois VARCHAR(6) NOT NULL, libelle VARCHAR(100) NOT NULL, date DATETIME NOT NULL, montant DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_EC01626D6760FECA (id_visiteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_frais (id INT AUTO_INCREMENT NOT NULL, id_visiteur_id INT NOT NULL, id_etat_id INT NOT NULL, mois VARCHAR(6) NOT NULL, nb_justificatifs INT NOT NULL, montnat_valide DOUBLE PRECISION NOT NULL, date_modif DATETIME NOT NULL, INDEX IDX_5FC0A6A76760FECA (id_visiteur_id), INDEX IDX_5FC0A6A7D3C32F8F (id_etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_frais_forfait (id INT AUTO_INCREMENT NOT NULL, id_visiteur_id INT NOT NULL, id_frais_forfait_id INT NOT NULL, mois VARCHAR(6) NOT NULL, quantite INT NOT NULL, INDEX IDX_BD293ECF6760FECA (id_visiteur_id), UNIQUE INDEX UNIQ_BD293ECF98FA628F (id_frais_forfait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_frais_hors_forfait ADD CONSTRAINT FK_EC01626D6760FECA FOREIGN KEY (id_visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE fiche_frais ADD CONSTRAINT FK_5FC0A6A76760FECA FOREIGN KEY (id_visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE fiche_frais ADD CONSTRAINT FK_5FC0A6A7D3C32F8F FOREIGN KEY (id_etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECF6760FECA FOREIGN KEY (id_visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECF98FA628F FOREIGN KEY (id_frais_forfait_id) REFERENCES frais_forfait (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_frais_forfait DROP FOREIGN KEY FK_BD293ECF98FA628F');
        $this->addSql('ALTER TABLE fiche_frais DROP FOREIGN KEY FK_5FC0A6A7D3C32F8F');
        $this->addSql('DROP TABLE frais_forfait');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE ligne_frais_hors_forfait');
        $this->addSql('DROP TABLE fiche_frais');
        $this->addSql('DROP TABLE ligne_frais_forfait');
    }
}
