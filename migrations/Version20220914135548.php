<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220914135548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admins` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(60) NOT NULL, UNIQUE INDEX UNIQ_A2E0150FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `clients` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode INT NOT NULL, city VARCHAR(50) NOT NULL, phone INT NOT NULL, active TINYINT(1) NOT NULL, short_description LONGTEXT DEFAULT NULL, full_description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_C82E74A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `permissions` (id INT AUTO_INCREMENT NOT NULL, sell_drinks TINYINT(1) NOT NULL, sale_vitamin_bar TINYINT(1) NOT NULL, manage_schedule TINYINT(1) NOT NULL, send_newsletter TINYINT(1) NOT NULL, locker_room TINYINT(1) NOT NULL, shower TINYINT(1) NOT NULL, sports_coach TINYINT(1) NOT NULL, app_fitness_drive TINYINT(1) NOT NULL, shop_fitness_drive TINYINT(1) NOT NULL, sale_other_products TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `structures` (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, name_structure VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode INT NOT NULL, city VARCHAR(50) NOT NULL, phone INT NOT NULL, active TINYINT(1) NOT NULL, short_description LONGTEXT DEFAULT NULL, full_description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5BBEC55A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure_permission (structure_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_D207A6E42534008B (structure_id), INDEX IDX_D207A6E4FED90CCA (permission_id), PRIMARY KEY(structure_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(60) NOT NULL, username VARCHAR(100) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admins` ADD CONSTRAINT FK_A2E0150FA76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `clients` ADD CONSTRAINT FK_C82E74A76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `structures` ADD CONSTRAINT FK_5BBEC55A19EB6921 FOREIGN KEY (client_id) REFERENCES `clients` (id)');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E42534008B FOREIGN KEY (structure_id) REFERENCES `structures` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E4FED90CCA FOREIGN KEY (permission_id) REFERENCES `permissions` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admins` DROP FOREIGN KEY FK_A2E0150FA76ED395');
        $this->addSql('ALTER TABLE `clients` DROP FOREIGN KEY FK_C82E74A76ED395');
        $this->addSql('ALTER TABLE `structures` DROP FOREIGN KEY FK_5BBEC55A19EB6921');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E42534008B');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E4FED90CCA');
        $this->addSql('DROP TABLE `admins`');
        $this->addSql('DROP TABLE `clients`');
        $this->addSql('DROP TABLE `permissions`');
        $this->addSql('DROP TABLE `structures`');
        $this->addSql('DROP TABLE structure_permission');
        $this->addSql('DROP TABLE `users`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
