<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104223445 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE word_data (id INT AUTO_INCREMENT NOT NULL, word_id INT NOT NULL, language_id INT NOT NULL, data VARCHAR(50000) NOT NULL, item_status SMALLINT NOT NULL, item_timestamp DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language MODIFY language_id INT NOT NULL');
        $this->addSql('ALTER TABLE language DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE language ADD id INT AUTO_INCREMENT NOT NULL, CHANGE language_id language_id INT NOT NULL, CHANGE item_status item_status SMALLINT NOT NULL, CHANGE item_timestamp item_timestamp DATETIME NOT NULL');
        $this->addSql('ALTER TABLE language ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user MODIFY user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user CHANGE item_status item_status SMALLINT NOT NULL, CHANGE item_timestamp item_timestamp DATETIME NOT NULL, CHANGE user_id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_has_word MODIFY user_has_word_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_has_word DROP FOREIGN KEY user_has_word_ibfk_1');
        $this->addSql('ALTER TABLE user_has_word DROP FOREIGN KEY user_has_word_ibfk_2');
        $this->addSql('DROP INDEX user_id ON user_has_word');
        $this->addSql('DROP INDEX word_id ON user_has_word');
        $this->addSql('ALTER TABLE user_has_word DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_has_word ADD id INT AUTO_INCREMENT NOT NULL, CHANGE user_has_word_id user_has_word_id INT NOT NULL, CHANGE item_status item_status SMALLINT NOT NULL, CHANGE item_timestamp item_timestamp DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user_has_word ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE word CHANGE item_status item_status SMALLINT DEFAULT 1 NOT NULL, CHANGE item_timestamp item_timestamp DATETIME NOT NULL');
        $this->addSql('ALTER TABLE word_translation DROP FOREIGN KEY word_translation_ibfk_1');
        $this->addSql('ALTER TABLE word_translation DROP FOREIGN KEY word_translation_ibfk_2');
        $this->addSql('DROP INDEX word_id ON word_translation');
        $this->addSql('DROP INDEX language_id ON word_translation');
        $this->addSql('ALTER TABLE word_translation CHANGE item_status item_status SMALLINT NOT NULL, CHANGE item_timestamp item_timestamp DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE word_data');
        $this->addSql('ALTER TABLE language MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE language DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE language DROP id, CHANGE language_id language_id INT AUTO_INCREMENT NOT NULL, CHANGE item_status item_status TINYINT(1) DEFAULT \'1\', CHANGE item_timestamp item_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE language ADD PRIMARY KEY (language_id)');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user CHANGE item_status item_status TINYINT(1) DEFAULT \'1\', CHANGE item_timestamp item_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE id user_id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (user_id)');
        $this->addSql('ALTER TABLE user_has_word MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user_has_word DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_has_word DROP id, CHANGE user_has_word_id user_has_word_id INT AUTO_INCREMENT NOT NULL, CHANGE item_status item_status TINYINT(1) DEFAULT \'1\', CHANGE item_timestamp item_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE user_has_word ADD CONSTRAINT user_has_word_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE user_has_word ADD CONSTRAINT user_has_word_ibfk_2 FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('CREATE INDEX user_id ON user_has_word (user_id)');
        $this->addSql('CREATE INDEX word_id ON user_has_word (word_id)');
        $this->addSql('ALTER TABLE user_has_word ADD PRIMARY KEY (user_has_word_id)');
        $this->addSql('ALTER TABLE word CHANGE item_status item_status TINYINT(1) DEFAULT \'1\', CHANGE item_timestamp item_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE word_translation CHANGE item_status item_status TINYINT(1) DEFAULT \'1\', CHANGE item_timestamp item_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE word_translation ADD CONSTRAINT word_translation_ibfk_1 FOREIGN KEY (word_id) REFERENCES word (id)');
        $this->addSql('ALTER TABLE word_translation ADD CONSTRAINT word_translation_ibfk_2 FOREIGN KEY (language_id) REFERENCES language (language_id)');
        $this->addSql('CREATE INDEX word_id ON word_translation (word_id)');
        $this->addSql('CREATE INDEX language_id ON word_translation (language_id)');
    }
}
