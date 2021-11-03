<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103134626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion DROP INDEX UNIQ_C0B9F90FACC27E61, ADD INDEX IDX_C0B9F90FACC27E61 (adopting_request_id)');
        $this->addSql('ALTER TABLE discussion ADD content LONGTEXT NOT NULL, DROP adopting, DROP advertiser, CHANGE creation_date creation_date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion DROP INDEX IDX_C0B9F90FACC27E61, ADD UNIQUE INDEX UNIQ_C0B9F90FACC27E61 (adopting_request_id)');
        $this->addSql('ALTER TABLE discussion ADD adopting LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', ADD advertiser LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:object)\', DROP content, CHANGE creation_date creation_date LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
