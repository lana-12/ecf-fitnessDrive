<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013103435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFEB516439407BA8 ON partners (name_partner)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFEB5164444F97DD ON partners (phone)');
        $this->addSql('ALTER TABLE permissions ADD title VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD is_active TINYINT(1) NOT NULL, DROP is_sell_drinks, DROP is_sale_vitamin_bar, DROP is_manage_schedule, DROP is_send_newsletter, DROP is_locker_room, DROP is_shower, DROP is_sports_coach, DROP is_app_fitness_drive, DROP is_shop_fitness_drive');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5BBEC55A13F109A8 ON structures (name_structure)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5BBEC55A444F97DD ON structures (phone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_EFEB516439407BA8 ON `partners`');
        $this->addSql('DROP INDEX UNIQ_EFEB5164444F97DD ON `partners`');
        $this->addSql('ALTER TABLE `permissions` ADD is_sale_vitamin_bar TINYINT(1) NOT NULL, ADD is_manage_schedule TINYINT(1) NOT NULL, ADD is_send_newsletter TINYINT(1) NOT NULL, ADD is_locker_room TINYINT(1) NOT NULL, ADD is_shower TINYINT(1) NOT NULL, ADD is_sports_coach TINYINT(1) NOT NULL, ADD is_app_fitness_drive TINYINT(1) NOT NULL, ADD is_shop_fitness_drive TINYINT(1) NOT NULL, DROP title, DROP description, CHANGE is_active is_sell_drinks TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_5BBEC55A13F109A8 ON `structures`');
        $this->addSql('DROP INDEX UNIQ_5BBEC55A444F97DD ON `structures`');
        $this->addSql('DROP INDEX UNIQ_1483A5E9F85E0677 ON `users`');
    }
}
