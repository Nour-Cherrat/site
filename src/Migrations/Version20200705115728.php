<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705115728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alumni CHANGE filename filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce CHANGE filename filename VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME NOT NULL, CHANGE pdfname pdfname VARCHAR(255) DEFAULT NULL, CHANGE date_debut date_debut DATE DEFAULT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE filiere ADD filename VARCHAR(255) DEFAULT NULL, ADD pdfname VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, CHANGE nom_resp nom_resp VARCHAR(255) DEFAULT NULL, CHANGE email_resp email_resp VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mot_doyen CHANGE filename filename VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alumni CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE annonce CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pdfname pdfname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE date_debut date_debut DATE DEFAULT \'NULL\', CHANGE date_fin date_fin DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE filiere DROP filename, DROP pdfname, DROP updated_at, CHANGE nom_resp nom_resp VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email_resp email_resp VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE mot_doyen CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
