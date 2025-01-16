<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116114401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939834ECB4E6');
        $this->addSql('ALTER TABLE truck DROP FOREIGN KEY FK_CDCCF30AC3423909');
        $this->addSql('ALTER TABLE route DROP FOREIGN KEY FK_2C42079C6957CCE');
        $this->addSql('DROP TABLE truck');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP INDEX IDX_F529939834ECB4E6 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP route_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE truck (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, availability VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, max_mass INT NOT NULL, max_volume INT NOT NULL, UNIQUE INDEX UNIQ_CDCCF30AC3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, truck_id INT DEFAULT NULL, route_date DATETIME NOT NULL, estimated_duration TIME NOT NULL, total_distance INT NOT NULL, INDEX IDX_2C42079C6957CCE (truck_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE truck ADD CONSTRAINT FK_CDCCF30AC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C42079C6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `order` ADD route_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939834ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F529939834ECB4E6 ON `order` (route_id)');
    }
}
