<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029080143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adopting (id INT NOT NULL, adopting_request_id INT DEFAULT NULL, INDEX IDX_8D193F4CACC27E61 (adopting_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adopting_request (id INT AUTO_INCREMENT NOT NULL, discussion_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2694B8B1ADED311 (discussion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advert (id INT AUTO_INCREMENT NOT NULL, advertiser_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, dogs_nb INT DEFAULT NULL, creation_date DATE NOT NULL, update_date DATE DEFAULT NULL, status TINYINT(1) NOT NULL, description VARCHAR(1000) DEFAULT NULL, url_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_54F1F40B989D9B62 (slug), INDEX IDX_54F1F40BBA2FCBC2 (advertiser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertiser (id INT NOT NULL, adopting_request_id INT DEFAULT NULL, organization_name VARCHAR(255) NOT NULL, INDEX IDX_93312772ACC27E61 (adopting_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, adopting LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', advertiser LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', content VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, adooption_request LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, advert_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, antecedents VARCHAR(255) DEFAULT NULL, lof TINYINT(1) NOT NULL, full_description VARCHAR(255) DEFAULT NULL, sociable TINYINT(1) DEFAULT NULL, is_adopted TINYINT(1) NOT NULL, INDEX IDX_812C397DD07ECCB6 (advert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog_adopting_request (dog_id INT NOT NULL, adopting_request_id INT NOT NULL, INDEX IDX_228D818D634DFEB (dog_id), INDEX IDX_228D818DACC27E61 (adopting_request_id), PRIMARY KEY(dog_id, adopting_request_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race_dog (race_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_942774876E59D40D (race_id), INDEX IDX_94277487634DFEB (dog_id), PRIMARY KEY(race_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE url_picture (id INT AUTO_INCREMENT NOT NULL, dogs_id INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_ABA819D5D0AFB20A (dogs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, register_date DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adopting ADD CONSTRAINT FK_8D193F4CACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('ALTER TABLE adopting ADD CONSTRAINT FK_8D193F4CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adopting_request ADD CONSTRAINT FK_2694B8B1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id)');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40BBA2FCBC2 FOREIGN KEY (advertiser_id) REFERENCES advertiser (id)');
        $this->addSql('ALTER TABLE advertiser ADD CONSTRAINT FK_93312772ACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id)');
        $this->addSql('ALTER TABLE advertiser ADD CONSTRAINT FK_93312772BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397DD07ECCB6 FOREIGN KEY (advert_id) REFERENCES advert (id)');
        $this->addSql('ALTER TABLE dog_adopting_request ADD CONSTRAINT FK_228D818D634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog_adopting_request ADD CONSTRAINT FK_228D818DACC27E61 FOREIGN KEY (adopting_request_id) REFERENCES adopting_request (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_dog ADD CONSTRAINT FK_942774876E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_dog ADD CONSTRAINT FK_94277487634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE url_picture ADD CONSTRAINT FK_ABA819D5D0AFB20A FOREIGN KEY (dogs_id) REFERENCES dog (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopting DROP FOREIGN KEY FK_8D193F4CACC27E61');
        $this->addSql('ALTER TABLE advertiser DROP FOREIGN KEY FK_93312772ACC27E61');
        $this->addSql('ALTER TABLE dog_adopting_request DROP FOREIGN KEY FK_228D818DACC27E61');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397DD07ECCB6');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40BBA2FCBC2');
        $this->addSql('ALTER TABLE adopting_request DROP FOREIGN KEY FK_2694B8B1ADED311');
        $this->addSql('ALTER TABLE dog_adopting_request DROP FOREIGN KEY FK_228D818D634DFEB');
        $this->addSql('ALTER TABLE race_dog DROP FOREIGN KEY FK_94277487634DFEB');
        $this->addSql('ALTER TABLE url_picture DROP FOREIGN KEY FK_ABA819D5D0AFB20A');
        $this->addSql('ALTER TABLE race_dog DROP FOREIGN KEY FK_942774876E59D40D');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE adopting DROP FOREIGN KEY FK_8D193F4CBF396750');
        $this->addSql('ALTER TABLE advertiser DROP FOREIGN KEY FK_93312772BF396750');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE adopting');
        $this->addSql('DROP TABLE adopting_request');
        $this->addSql('DROP TABLE advert');
        $this->addSql('DROP TABLE advertiser');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE dog_adopting_request');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_dog');
        $this->addSql('DROP TABLE url_picture');
        $this->addSql('DROP TABLE user');
    }
}
