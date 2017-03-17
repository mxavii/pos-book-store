<?php

use Phinx\Migration\AbstractMigration;

class CreateTabelOrderItem extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $orderItem = $this->table('order_items');
        $orderItem->addColumn('order_id', 'integer')
                  ->addColumn('product_id', 'integer')
                  ->addColumn('quantity', 'integer')
                  ->addColumn('deleted', 'integer', ['default' => 0])
                  ->addForeignKey('order_id', 'orders', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                  ->addForeignKey('product_id', 'product', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                  ->create();
    }
}