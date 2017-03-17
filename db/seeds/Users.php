<?php

use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
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
            'username'  =>  'admin',
            'password'  =>  sha1('superadmin'),
            'name'      =>  'Admin',
            'status'    =>  '0',
        ];
        
        $data[] = [
            'username'  =>  'kasir',
            'password'  =>  sha1('kasir'),
            'name'      =>  'Kasir',
        ];

        $this->insert('users', $data);
    }
}
