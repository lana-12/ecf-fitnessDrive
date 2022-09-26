<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926135731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admins` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `partners` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name_partner VARCHAR(50) NOT NULL, phone INT NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_EFEB5164A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `permissions` (id INT AUTO_INCREMENT NOT NULL, is_sell_drinks TINYINT(1) NOT NULL, is_sale_vitamin_bar TINYINT(1) NOT NULL, is_manage_schedule TINYINT(1) NOT NULL, is_send_newsletter TINYINT(1) NOT NULL, is_locker_room TINYINT(1) NOT NULL, is_shower TINYINT(1) NOT NULL, is_sports_coach TINYINT(1) NOT NULL, is_app_fitness_drive TINYINT(1) NOT NULL, is_shop_fitness_drive TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `structures` (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, name_structure VARCHAR(50) NOT NULL, address VARCHAR(100) NOT NULL, zipcode INT NOT NULL, city VARCHAR(50) NOT NULL, phone INT NOT NULL, is_active TINYINT(1) NOT NULL, full_description VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, INDEX IDX_5BBEC55A9393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure_permission (structure_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_D207A6E42534008B (structure_id), INDEX IDX_D207A6E4FED90CCA (permission_id), PRIMARY KEY(structure_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `users` (id INT AUTO_INCREMENT NOT NULL, structure_id INT DEFAULT NULL, admin_user_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(60) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_1483A5E92534008B (structure_id), UNIQUE INDEX UNIQ_1483A5E96352511C (admin_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `partners` ADD CONSTRAINT FK_EFEB5164A76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE `structures` ADD CONSTRAINT FK_5BBEC55A9393F8FE FOREIGN KEY (partner_id) REFERENCES `partners` (id)');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E42534008B FOREIGN KEY (structure_id) REFERENCES `structures` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E4FED90CCA FOREIGN KEY (permission_id) REFERENCES `permissions` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `users` ADD CONSTRAINT FK_1483A5E92534008B FOREIGN KEY (structure_id) REFERENCES `structures` (id)');
        $this->addSql('ALTER TABLE `users` ADD CONSTRAINT FK_1483A5E96352511C FOREIGN KEY (admin_user_id) REFERENCES `admins` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `partners` DROP FOREIGN KEY FK_EFEB5164A76ED395');
        $this->addSql('ALTER TABLE `structures` DROP FOREIGN KEY FK_5BBEC55A9393F8FE');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E42534008B');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E4FED90CCA');
        $this->addSql('ALTER TABLE `users` DROP FOREIGN KEY FK_1483A5E92534008B');
        $this->addSql('ALTER TABLE `users` DROP FOREIGN KEY FK_1483A5E96352511C');
        $this->addSql('DROP TABLE `admins`');
        $this->addSql('DROP TABLE `partners`');
        $this->addSql('DROP TABLE `permissions`');
        $this->addSql('DROP TABLE `structures`');
        $this->addSql('DROP TABLE structure_permission');
        $this->addSql('DROP TABLE `users`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
