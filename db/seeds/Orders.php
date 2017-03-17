<?php

use Phinx\Seed\AbstractSeed;

class Orders extends AbstractSeed
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
            'user_id'   =>  '2',
            'total_price'   =>  '100000',
        ];

        $data[] = [
            'user_id'   =>  '2',
            'total_price'   =>  '150000',
        ];

        $this->insert('orders', $data);
    }
}
