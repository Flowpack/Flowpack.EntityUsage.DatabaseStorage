<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210419144652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Adds a table to store entity usage references and their metadata';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flowpack_entityusage_databasestorage_domain_model_entityusage (persistence_object_identifier VARCHAR(40) NOT NULL, usageid VARCHAR(255) NOT NULL, entityid VARCHAR(255) NOT NULL, serviceid VARCHAR(255) NOT NULL, metadata LONGTEXT NOT NULL COMMENT \'(DC2Type:flow_json_array)\', INDEX entityserviceid (usageid, entityid, serviceid), INDEX serviceindex (serviceid), INDEX usageindex (usageid), INDEX entityindex (entityid), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flowpack_entityusage_databasestorage_domain_model_entityusage');
    }
}
