<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103102534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting DROP FOREIGN KEY FK_8D193F4CACC27E61');
        $this->addSql('DROP INDEX IDX_8D193F4CACC27E61 ON adopting');
        $this->addSql('ALTER TABLE adopting DROP adopting_request_id');
        $this->addSql('ALTER TABLE adopting_request DROP FOREIGN KEY FK_2694B8B1ADED311');
        $this->addSql('DROP INDEX UNIQ_2694B8B1ADED311 ON adopting_request');
        $this->addSql('ALTER TABLE adopting_request CHANGE discussion_id adopting_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopting_request ADD CONSTRAINT FK_2694B8B237433E5 FOREIGN KEY (adopting_id) REFERENCES adopting (id)');
        $this->addSql('CREATE INDEX IDX_2694B8B237433E5 ON adopting_request (adopting_id)');
        $this->addSql('ALTER TABLE advert ADD adopting_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('CREATE INDEX IDX_54F1F40BACC27E61 ON advert (adopting_request_id)');
        $this->addSql('ALTER TABLE advertiser DROP FOREIGN KEY FK_93312772ACC27E61');
        $this->addSql('DROP INDEX IDX_93312772ACC27E61 ON advertiser');
        $this->addSql('ALTER TABLE advertiser DROP adopting_request_id');
        $this->addSql('ALTER TABLE discussion ADD adopting_request_id INT DEFAULT NULL, DROP content, DROP adooption_request, CHANGE creation_date creation_date LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0B9F90FACC27E61 ON discussion (adopting_request_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting ADD adopting_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopting ADD CONSTRAINT FK_8D193F4CACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D193F4CACC27E61 ON adopting (adopting_request_id)');
        $this->addSql('ALTER TABLE adopting_request DROP FOREIGN KEY FK_2694B8B237433E5');
        $this->addSql('DROP INDEX IDX_2694B8B237433E5 ON adopting_request');
        $this->addSql('ALTER TABLE adopting_request CHANGE adopting_id discussion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adopting_request ADD CONSTRAINT FK_2694B8B1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2694B8B1ADED311 ON adopting_request (discussion_id)');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BACC27E61');
        $this->addSql('DROP INDEX IDX_54F1F40BACC27E61 ON advert');
        $this->addSql('ALTER TABLE advert DROP adopting_request_id');
        $this->addSql('ALTER TABLE advertiser ADD adopting_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advertiser ADD CONSTRAINT FK_93312772ACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_93312772ACC27E61 ON advertiser (adopting_request_id)');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FACC27E61');
        $this->addSql('DROP INDEX UNIQ_C0B9F90FACC27E61 ON discussion');
        $this->addSql('ALTER TABLE discussion ADD content VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adooption_request LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', DROP adopting_request_id, CHANGE creation_date creation_date DATE NOT NULL');
    }
}
