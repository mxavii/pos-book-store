<?php

use Phinx\Seed\AbstractSeed;

class OrderItems extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data[] = [
            'order_id'      => '1',
            'product_id'    => '1',
            'quantity'      =>  '2',
        ];

        $data[] = [
            'order_id'      => '1',
            'product_id'    => '1',
            'quantity'      =>  '3',
        ];

        $this->insert('order_items', $data);
    }
}
