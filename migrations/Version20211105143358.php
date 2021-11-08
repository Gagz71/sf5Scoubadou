<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211105143358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting_request ADD advertiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopting_request ADD CONSTRAINT FK_2694B8BBA2FCBC2 FOREIGN KEY (advertiser_id) REFERENCES advertiser (id)');
        $this->addSql('CREATE INDEX IDX_2694B8BBA2FCBC2 ON adopting_request (advertiser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting_request DROP FOREIGN KEY FK_2694B8BBA2FCBC2');
        $this->addSql('DROP INDEX IDX_2694B8BBA2FCBC2 ON adopting_request');
        $this->addSql('ALTER TABLE adopting_request DROP advertiser_id');
    }
}
