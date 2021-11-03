<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102142901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BBA2FCBC2 FOREIGN KEY (advertiser_id) REFERENCES advertiser (id)');
        $this->addSql('ALTER TABLE advert RENAME INDEX fk_54f1f40bacc27e61 TO IDX_54F1F40BACC27E61');
        $this->addSql('ALTER TABLE advertiser DROP FOREIGN KEY FK_93312772ACC27E61');
        $this->addSql('DROP INDEX IDX_93312772ACC27E61 ON advertiser');
        $this->addSql('ALTER TABLE advertiser DROP adopting_request_id');
        $this->addSql('ALTER TABLE discussion ADD adopting_request_id INT NOT NULL, DROP adopting, DROP advertiser, DROP adooption_request');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('CREATE INDEX IDX_C0B9F90FACC27E61 ON discussion (adopting_request_id)');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DD07ECCB6');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DD07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BBA2FCBC2');
        $this->addSql('ALTER TABLE advert RENAME INDEX idx_54f1f40bacc27e61 TO FK_54F1F40BACC27E61');
        $this->addSql('ALTER TABLE advertiser ADD adopting_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advertiser ADD CONSTRAINT FK_93312772ACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('CREATE INDEX IDX_93312772ACC27E61 ON advertiser (adopting_request_id)');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FACC27E61');
        $this->addSql('DROP INDEX IDX_C0B9F90FACC27E61 ON discussion');
        $this->addSql('ALTER TABLE discussion ADD adopting LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', ADD advertiser LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', ADD adooption_request LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', DROP adopting_request_id');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DD07ECCB6');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DD07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
    }
}
