<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211109124412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting_request DROP FOREIGN KEY FK_2694B8BBA2FCBC2');
        $this->addSql('DROP INDEX IDX_2694B8BBA2FCBC2 ON adopting_request');
        $this->addSql('ALTER TABLE adopting_request DROP advertiser_id');
        $this->addSql('ALTER TABLE discussion ADD sender_id INT DEFAULT NULL, ADD receiver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C0B9F90FF624B39D ON discussion (sender_id)');
        $this->addSql('CREATE INDEX IDX_C0B9F90FCD53EDB6 ON discussion (receiver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting_request ADD advertiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopting_request ADD CONSTRAINT FK_2694B8BBA2FCBC2 FOREIGN KEY (advertiser_id) REFERENCES advertiser (id)');
        $this->addSql('CREATE INDEX IDX_2694B8BBA2FCBC2 ON adopting_request (advertiser_id)');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FF624B39D');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FCD53EDB6');
        $this->addSql('DROP INDEX IDX_C0B9F90FF624B39D ON discussion');
        $this->addSql('DROP INDEX IDX_C0B9F90FCD53EDB6 ON discussion');
        $this->addSql('ALTER TABLE discussion DROP sender_id, DROP receiver_id');
    }
}
