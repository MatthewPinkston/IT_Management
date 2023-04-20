<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

use Ramsey\Uuid\Uuid;

final class AssetTrackingTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $assets = $this->table('Asset_Tracking', ['id' => false, 'primary_key' => 'id']);

        $assets
            -> addColumn('id', 'uuid', ['null' => false])
            -> addColumn('name', 'string', ['limit' => 50, 'null' => false])
            -> addColumn('type', 'enum', ['values' => ['Computers', 'Storage', 'IO'], 'default' => 'Computers'])
            -> addColumn('totalPurchased', 'integer', ['null' => false])
            -> addColumn('inStock', 'integer', ['null' => false])
            -> addColumn('inCondition', 'integer', ['null' => false])
            -> addColumn('assigned', 'integer', ['null' => false])
            -> addColumn('notInCondition', 'integer', ['null' => false]);
        
        $assets->create();

        //Inserting sample data
        $data = [
            [
                'id' => Uuid::uuid4(),
                'name' => 'Lenevo Laptop',
                'type' => 'Computers',
                'totalPurchased' => 5,
                'inStock' => 2,
                'inCondition' => 4,
                'assigned' => 2,
                'notInCondition' => 1
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Asc Mem',
                'type' => 'Storage',
                'totalPurchased' => 5,
                'inStock' => 2,
                'inCondition' => 4,
                'assigned' => 2,
                'notInCondition' => 1
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Dell Printer',
                'type' => 'IO',
                'totalPurchased' => 5,
                'inStock' => 2,
                'inCondition' => 4,
                'assigned' => 2,
                'notInCondition' => 1
            ],
        ];

        $assets->insert($data)->saveData();
    }
}
