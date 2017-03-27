<?php

use Phinx\Seed\AbstractSeed;

class Product extends AbstractSeed
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
        for ($i = 0; $i < 5 ; $i++) {
            $data[] = [
                'category_id'   =>  '2',
                'title'         =>  'Test',
                'short_desc'          =>  'Test Data Buku',
                'price'         =>  '50000',
                'image'         =>  'book.jpg'
            ];
        }

        $this->insert('product', $data);
    }
}
