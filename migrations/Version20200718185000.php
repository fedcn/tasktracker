<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200718185000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boards (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_F3EE4D137E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE columns (id INT AUTO_INCREMENT NOT NULL, board_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, `order` INT NOT NULL, INDEX IDX_ACCEC0B7E7EC5785 (board_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, column_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, changed_at DATETIME NOT NULL, deadline_at DATETIME NOT NULL, INDEX IDX_50586597BE8E8ED5 (column_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_users_boards (user_id INT NOT NULL, board_id INT NOT NULL, INDEX IDX_18FD0570A76ED395 (user_id), INDEX IDX_18FD0570E7EC5785 (board_id), PRIMARY KEY(user_id, board_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boards ADD CONSTRAINT FK_F3EE4D137E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE columns ADD CONSTRAINT FK_ACCEC0B7E7EC5785 FOREIGN KEY (board_id) REFERENCES boards (id)');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_50586597BE8E8ED5 FOREIGN KEY (column_id) REFERENCES columns (id)');
        $this->addSql('ALTER TABLE ref_users_boards ADD CONSTRAINT FK_18FD0570A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ref_users_boards ADD CONSTRAINT FK_18FD0570E7EC5785 FOREIGN KEY (board_id) REFERENCES boards (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE columns DROP FOREIGN KEY FK_ACCEC0B7E7EC5785');
        $this->addSql('ALTER TABLE ref_users_boards DROP FOREIGN KEY FK_18FD0570E7EC5785');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_50586597BE8E8ED5');
        $this->addSql('ALTER TABLE boards DROP FOREIGN KEY FK_F3EE4D137E3C61F9');
        $this->addSql('ALTER TABLE ref_users_boards DROP FOREIGN KEY FK_18FD0570A76ED395');
        $this->addSql('DROP TABLE boards');
        $this->addSql('DROP TABLE columns');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE ref_users_boards');
    }
}
