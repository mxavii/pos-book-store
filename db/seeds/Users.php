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
            'password'  =>  password_hash('superadmin', PASSWORD_DEFAULT),
            'name'      =>  'Admin',
            'status'    =>  '0',
        ];
        
        $data[] = [
            'username'  =>  'kasir',
            'password'  =>  password_hash('kasir', PASSWORD_DEFAULT),
            'name'      =>  'Kasir',
        ];

        $this->insert('users', $data);
    }
}
