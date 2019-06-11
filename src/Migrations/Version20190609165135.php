<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190609165135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_7D053A9377153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_item (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, link_type VARCHAR(255) DEFAULT NULL, link_type_id INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, target VARCHAR(255) DEFAULT NULL, INDEX IDX_D754D550CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D550CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_item DROP FOREIGN KEY FK_D754D550CCD7E912');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_item');
    }
}
