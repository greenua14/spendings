<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160628091619 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        // New table `categories`
        $categories = $schema->createTable('categories');
        $categories->addColumn('id', 'integer', ['limit' => 11, 'null' => false, 'autoincrement' => true]);
        $categories->addColumn('status', 'integer', ['limit' => 1, 'null' => false]);
        $categories->addColumn('symbol', 'string', ['limit' => 255, 'null' => false, 'unique' => true]);
        $categories->addColumn('name', 'string', ['limit' => 255, 'null' => false]);
        $categories->addColumn('description', 'text', ['null' => true]);
        $categories->addColumn('created', 'datetime');
        $categories->setPrimaryKey(['id']);

        // New table `spendings`
        $spendings = $schema->createTable('spendings');
        $spendings->addColumn('id', 'integer', ['limit' => 11, 'null' => false, 'autoincrement' => true]);
        $spendings->addColumn('status', 'integer', ['limit' => 1, 'null' => false]);
        $spendings->addColumn('category', 'integer', ['limit' => 11, 'null' => false]);
        $spendings->addColumn('price', 'decimal', ['null' => false]);
        $spendings->addColumn('description', 'text', ['null' => true]);
        $spendings->addColumn('created', 'datetime');
        $spendings->addColumn('updated', 'datetime');
        $spendings->setPrimaryKey(['id']);

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('categories');
        $schema->dropTable('spendings');

    }
}
