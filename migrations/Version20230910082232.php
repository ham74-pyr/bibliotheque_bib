<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230910082232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD id INT AUTO_INCREMENT NOT NULL, ADD email VARCHAR(180) NOT NULL, ADD subject VARCHAR(100) DEFAULT NULL, ADD message LONGTEXT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON contact');
        $this->addSql('ALTER TABLE contact DROP id, DROP email, DROP subject, DROP message, DROP created_at');
    }
}
