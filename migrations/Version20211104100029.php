<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104100029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting_request ADD advert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopting_request ADD CONSTRAINT FK_2694B8BD07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
        $this->addSql('CREATE INDEX IDX_2694B8BD07ECCB6 ON adopting_request (advert_id)');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BACC27E61');
        $this->addSql('DROP INDEX IDX_54F1F40BACC27E61 ON advert');
        $this->addSql('ALTER TABLE advert DROP adopting_request_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting_request DROP FOREIGN KEY FK_2694B8BD07ECCB6');
        $this->addSql('DROP INDEX IDX_2694B8BD07ECCB6 ON adopting_request');
        $this->addSql('ALTER TABLE adopting_request DROP advert_id');
        $this->addSql('ALTER TABLE advert ADD adopting_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('CREATE INDEX IDX_54F1F40BACC27E61 ON advert (adopting_request_id)');
    }
}
