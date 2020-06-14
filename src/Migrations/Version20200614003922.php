<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614003922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, about LONGTEXT NOT NULL, mission LONGTEXT NOT NULL, vision LONGTEXT NOT NULL, histoire LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce CHANGE filename filename VARCHAR(255) DEFAULT NULL, CHANGE statut statut INT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE presentation');
        $this->addSql('ALTER TABLE annonce CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\'\'NULL\'\'\' COLLATE `utf8mb4_unicode_ci`, CHANGE statut statut INT DEFAULT 0');
    }
}
