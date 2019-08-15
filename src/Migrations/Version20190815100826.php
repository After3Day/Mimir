<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190815100826 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387248E1E977');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872526E8E58');
        $this->addSql('DROP INDEX UNIQ_B8EE387248E1E977 ON club');
        $this->addSql('DROP INDEX UNIQ_B8EE3872526E8E58 ON club');
        $this->addSql('ALTER TABLE club ADD contact_id INT NOT NULL, ADD address_id INT NOT NULL, DROP contact_id_id, DROP address_id_id');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872E7A1254A ON club (contact_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872F5B7AF75 ON club (address_id)');
        $this->addSql('ALTER TABLE collector DROP FOREIGN KEY FK_CEDBF54C526E8E58');
        $this->addSql('DROP INDEX UNIQ_CEDBF54C526E8E58 ON collector');
        $this->addSql('ALTER TABLE collector CHANGE contact_id_id contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE collector ADD CONSTRAINT FK_CEDBF54CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CEDBF54CE7A1254A ON collector (contact_id)');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63848E1E977');
        $this->addSql('DROP INDEX UNIQ_4C62E63848E1E977 ON contact');
        $this->addSql('ALTER TABLE contact CHANGE address_id_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638F5B7AF75 ON contact (address_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA748E1E977');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7526E8E58');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7526E8E58 ON event');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA748E1E977 ON event');
        $this->addSql('ALTER TABLE event CHANGE address_id_id address_id INT NOT NULL, CHANGE contact_id_id contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7F5B7AF75 ON event (address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7E7A1254A ON event (contact_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CDA88AC48');
        $this->addSql('DROP INDEX IDX_6A2CA10CDA88AC48 ON media');
        $this->addSql('ALTER TABLE media CHANGE modele_id_id modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CAC14B70A ON media (modele_id)');
        $this->addSql('ALTER TABLE modele ADD brand_id INT NOT NULL, DROP manufacturer_name');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_1002855844F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_1002855844F5D008 ON modele (brand_id)');
        $this->addSql('ALTER TABLE version DROP FOREIGN KEY FK_BF1CD3C3DA88AC48');
        $this->addSql('DROP INDEX IDX_BF1CD3C3DA88AC48 ON version');
        $this->addSql('ALTER TABLE version CHANGE modele_id_id modele_id INT NOT NULL');
        $this->addSql('ALTER TABLE version ADD CONSTRAINT FK_BF1CD3C3AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_BF1CD3C3AC14B70A ON version (modele_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_1002855844F5D008');
        $this->addSql('DROP TABLE brand');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872E7A1254A');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_B8EE3872E7A1254A ON club');
        $this->addSql('DROP INDEX UNIQ_B8EE3872F5B7AF75 ON club');
        $this->addSql('ALTER TABLE club ADD contact_id_id INT NOT NULL, ADD address_id_id INT NOT NULL, DROP contact_id, DROP address_id');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387248E1E977 FOREIGN KEY (address_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872526E8E58 FOREIGN KEY (contact_id_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE387248E1E977 ON club (address_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872526E8E58 ON club (contact_id_id)');
        $this->addSql('ALTER TABLE collector DROP FOREIGN KEY FK_CEDBF54CE7A1254A');
        $this->addSql('DROP INDEX UNIQ_CEDBF54CE7A1254A ON collector');
        $this->addSql('ALTER TABLE collector CHANGE contact_id contact_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE collector ADD CONSTRAINT FK_CEDBF54C526E8E58 FOREIGN KEY (contact_id_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CEDBF54C526E8E58 ON collector (contact_id_id)');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_4C62E638F5B7AF75 ON contact');
        $this->addSql('ALTER TABLE contact CHANGE address_id address_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63848E1E977 FOREIGN KEY (address_id_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E63848E1E977 ON contact (address_id_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7F5B7AF75');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7E7A1254A');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7F5B7AF75 ON event');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7E7A1254A ON event');
        $this->addSql('ALTER TABLE event CHANGE contact_id contact_id_id INT DEFAULT NULL, CHANGE address_id address_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA748E1E977 FOREIGN KEY (address_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7526E8E58 FOREIGN KEY (contact_id_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7526E8E58 ON event (contact_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA748E1E977 ON event (address_id_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CAC14B70A');
        $this->addSql('DROP INDEX IDX_6A2CA10CAC14B70A ON media');
        $this->addSql('ALTER TABLE media CHANGE modele_id modele_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CDA88AC48 FOREIGN KEY (modele_id_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CDA88AC48 ON media (modele_id_id)');
        $this->addSql('DROP INDEX IDX_1002855844F5D008 ON modele');
        $this->addSql('ALTER TABLE modele ADD manufacturer_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP brand_id');
        $this->addSql('ALTER TABLE version DROP FOREIGN KEY FK_BF1CD3C3AC14B70A');
        $this->addSql('DROP INDEX IDX_BF1CD3C3AC14B70A ON version');
        $this->addSql('ALTER TABLE version CHANGE modele_id modele_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE version ADD CONSTRAINT FK_BF1CD3C3DA88AC48 FOREIGN KEY (modele_id_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_BF1CD3C3DA88AC48 ON version (modele_id_id)');
    }
}
