<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112091532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, compagny_id INT NOT NULL, name VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, tag VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F65593E51224ABE0 (compagny_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, adres VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, image_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carousel (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, text LONGTEXT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, tag VARCHAR(255) DEFAULT NULL, image_name1 VARCHAR(255) DEFAULT NULL, image_name2 VARCHAR(255) DEFAULT NULL, image_name3 VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cartes (id INT AUTO_INCREMENT NOT NULL, carousel_id INT NOT NULL, titre VARCHAR(255) NOT NULL, texte LONGTEXT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, tag VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D8B89555C1CE5B98 (carousel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagny (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adres VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, compagny_id INT NOT NULL, name VARCHAR(255) NOT NULL, adres VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, tag VARCHAR(255) NOT NULL, INDEX IDX_404021BF1224ABE0 (compagny_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, texte LONGTEXT NOT NULL, signature VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E51224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id)');
        $this->addSql('ALTER TABLE cartes ADD CONSTRAINT FK_D8B89555C1CE5B98 FOREIGN KEY (carousel_id) REFERENCES carousel (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF1224ABE0 FOREIGN KEY (compagny_id) REFERENCES compagny (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E51224ABE0');
        $this->addSql('ALTER TABLE cartes DROP FOREIGN KEY FK_D8B89555C1CE5B98');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF1224ABE0');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE carousel');
        $this->addSql('DROP TABLE cartes');
        $this->addSql('DROP TABLE compagny');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE home');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
