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
            -> addColumn('assetType', 'string', ['limit' => 50, 'null' => false])
            -> addColumn('totalPurchased', 'integer', ['null' => false])
            -> addColumn('isActive', 'enum', ['values' => ['Yes', 'No', 'NA'], 'default' => 'Yes'])
            -> addColumn('assigned', 'integer', ['null' => false]);
        
        $assets->create();

        //Inserting sample data
        $data = [
            [
                'id' => Uuid::uuid4(),
                'name' => 'Lenevo Laptops',
                'assetType' => 'Computers',
                'totalPurchased' => 5,
                'isActive' => 'Yes',
                'assigned' => 2
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Dell Laptops',
                'assetType' => 'Computers',
                'totalPurchased' => 5,
                'isActive' => 'Yes',
                'assigned' => 2
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Dell Desktops',
                'assetType' => 'Computers',
                'totalPurchased' => 5,
                'isActive' => 'Yes',
                'assigned' => 2
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'HP Printers',
                'assetType' => 'Printers',
                'totalPurchased' => 5,
                'isActive' => 'Yes',
                'assigned' => 2
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Pendrives',
                'assetType' => 'Memory',
                'totalPurchased' => 5,
                'isActive' => 'Yes',
                'assigned' => 2
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Headsets',
                'assetType' => 'IO',
                'totalPurchased' => 5,
                'isActive' => 'Yes',
                'assigned' => 2
            ],
        ];

        $assets->insert($data)->saveData();
    }
}
