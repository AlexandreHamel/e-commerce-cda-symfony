<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115093448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories ADD productspromotions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346682D7C828E FOREIGN KEY (productspromotions_id) REFERENCES products_promotions (id)');
        $this->addSql('CREATE INDEX IDX_3AF346682D7C828E ON categories (productspromotions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346682D7C828E');
        $this->addSql('DROP INDEX IDX_3AF346682D7C828E ON categories');
        $this->addSql('ALTER TABLE categories DROP productspromotions_id');
    }
}
