<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181021184926 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'CREATE TABLE language (
            language_id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            item_status TINYINT NULL DEFAULT 1,
            item_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(language_id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE user (
            user_id INT AUTO_INCREMENT NOT NULL,
            login VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            item_status TINYINT NULL DEFAULT 1,
            item_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(user_id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE word (
            word_id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            item_status TINYINT NULL DEFAULT 1,
            item_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(word_id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE user_has_word (
            user_has_word_id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            word_id INT NOT NULL,
            item_status TINYINT NULL DEFAULT 1,
            item_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(user_has_word_id),
            FOREIGN KEY (user_id) REFERENCES user(user_id),
            FOREIGN KEY (word_id) REFERENCES word(word_id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE word_translation (
            word_translation_id INT AUTO_INCREMENT NOT NULL,
            word_id INT NOT NULL,
            language_id INT NOT NULL,
            meaning VARCHAR(5000) NOT NULL,
            item_status TINYINT NULL DEFAULT 1,
            item_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(word_translation_id),
            FOREIGN KEY (word_id) REFERENCES word(word_id), 
            FOREIGN KEY (language_id) REFERENCES language(language_id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE word_translation');
        $this->addSql('DROP TABLE user_has_word');
        $this->addSql('DROP TABLE word');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE language');
    }
}
