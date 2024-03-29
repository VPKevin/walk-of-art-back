<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404152649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE board_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exhibition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gallery_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE work_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE work_files_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE board (id INT NOT NULL, gallery_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_58562B474E7AF8F ON board (gallery_id)');
        $this->addSql('COMMENT ON COLUMN board.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE exhibition (id INT NOT NULL, revision_id INT DEFAULT NULL, work_id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, reaction BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B83533891DFA7C8F ON exhibition (revision_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8353389BB3453DB ON exhibition (work_id)');
        $this->addSql('CREATE INDEX IDX_B8353389A76ED395 ON exhibition (user_id)');
        $this->addSql('COMMENT ON COLUMN exhibition.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE gallery (id INT NOT NULL, name VARCHAR(255) NOT NULL, gps_lat NUMERIC(8, 6) NOT NULL, gps_long NUMERIC(9, 6) NOT NULL, price NUMERIC(5, 2) NOT NULL, max_days INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN gallery.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, gallery_id INT NOT NULL, date_start DATE NOT NULL, duration INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C849554E7AF8F ON reservation (gallery_id)');
        $this->addSql('COMMENT ON COLUMN reservation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE work (id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_534E6880A76ED395 ON work (user_id)');
        $this->addSql('COMMENT ON COLUMN work.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE work_files (id INT NOT NULL, work_id INT NOT NULL, path_file VARCHAR(255) NOT NULL, main BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2ECE3B76BB3453DB ON work_files (work_id)');
        $this->addSql('ALTER TABLE board ADD CONSTRAINT FK_58562B474E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exhibition ADD CONSTRAINT FK_B83533891DFA7C8F FOREIGN KEY (revision_id) REFERENCES exhibition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exhibition ADD CONSTRAINT FK_B8353389BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exhibition ADD CONSTRAINT FK_B8353389A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_files ADD CONSTRAINT FK_2ECE3B76BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE exhibition DROP CONSTRAINT FK_B83533891DFA7C8F');
        $this->addSql('ALTER TABLE board DROP CONSTRAINT FK_58562B474E7AF8F');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849554E7AF8F');
        $this->addSql('ALTER TABLE exhibition DROP CONSTRAINT FK_B8353389A76ED395');
        $this->addSql('ALTER TABLE work DROP CONSTRAINT FK_534E6880A76ED395');
        $this->addSql('ALTER TABLE exhibition DROP CONSTRAINT FK_B8353389BB3453DB');
        $this->addSql('ALTER TABLE work_files DROP CONSTRAINT FK_2ECE3B76BB3453DB');
        $this->addSql('DROP SEQUENCE board_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exhibition_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gallery_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE work_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE work_files_id_seq CASCADE');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE exhibition');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE work');
        $this->addSql('DROP TABLE work_files');
    }
}
