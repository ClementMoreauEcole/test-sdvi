<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625173615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza DROP FOREIGN KEY FK_551E6DE22D6B7F14');
        $this->addSql('DROP INDEX IDX_551E6DE22D6B7F14 ON nombre_ingredient_par_pizza');
        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza DROP Pizza_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza ADD Pizza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nombre_ingredient_par_pizza ADD CONSTRAINT FK_551E6DE22D6B7F14 FOREIGN KEY (Pizza_id) REFERENCES pizza (id_pizza)');
        $this->addSql('CREATE INDEX IDX_551E6DE22D6B7F14 ON nombre_ingredient_par_pizza (Pizza_id)');
    }
}
