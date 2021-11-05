<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104125207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FE92F8F78');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FF624B39D');
        $this->addSql('DROP INDEX IDX_C0B9F90FE92F8F78 ON discussion');
        $this->addSql('DROP INDEX IDX_C0B9F90FF624B39D ON discussion');
        $this->addSql('ALTER TABLE discussion DROP sender_id, DROP recipient_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion ADD sender_id INT NOT NULL, ADD recipient_id INT NOT NULL');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FE92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C0B9F90FE92F8F78 ON discussion (recipient_id)');
        $this->addSql('CREATE INDEX IDX_C0B9F90FF624B39D ON discussion (sender_id)');
    }
}
