<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // create default user
        $data = [
            'displayname' => 'Admin VIANET',
            'username' => 'admin',
            'password' => hash('sha512', '1234dan5'),
            'email'    => 'admin@admin.com',
            'id_level'    => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('tbluser')->insert($data);
    }
}
