<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026083108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race_dog (race_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_942774876E59D40D (race_id), INDEX IDX_94277487634DFEB (dog_id), PRIMARY KEY(race_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE race_dog ADD CONSTRAINT FK_942774876E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_dog ADD CONSTRAINT FK_94277487634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE race_dog DROP FOREIGN KEY FK_942774876E59D40D');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_dog');
    }
}
