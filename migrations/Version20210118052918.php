<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118052918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE reader_personal_account_id_seq CASCADE');
        $this->addSql('ALTER TABLE category ADD reader_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C13DD1D4AF FOREIGN KEY (reader_personal_account_id) REFERENCES reader_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11717D737 FOREIGN KEY (reader_id) REFERENCES reader (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_64C19C11717D737 ON category (reader_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE reader_personal_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C13DD1D4AF');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C11717D737');
        $this->addSql('DROP INDEX IDX_64C19C11717D737');
        $this->addSql('ALTER TABLE category DROP reader_id');
    }
}
