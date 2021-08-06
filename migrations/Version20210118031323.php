<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210118031323 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return '';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE reader_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reader_account (id INT NOT NULL, name_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F5BEE6871179CD6 ON reader_account (name_id)');
        $this->addSql('ALTER TABLE reader_account ADD CONSTRAINT FK_1F5BEE6871179CD6 FOREIGN KEY (name_id) REFERENCES reader (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD reader_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11CC109A9 FOREIGN KEY (reader_account_id) REFERENCES reader_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_64C19C11CC109A9 ON category (reader_account_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C11CC109A9');
        $this->addSql('DROP SEQUENCE reader_account_id_seq CASCADE');
        $this->addSql('DROP TABLE reader_account');
        $this->addSql('DROP INDEX IDX_64C19C11CC109A9');
        $this->addSql('ALTER TABLE category DROP reader_account_id');
    }
}
