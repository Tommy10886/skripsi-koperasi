<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        //create default level
        
        $data = [
            'level_name' => 'admin system',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('tbllevel')->insert($data);

        $data = [
            'level_name' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('tbllevel')->insert($data);
        
        $data = [
            'level_name' => 'pelanggan',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('tbllevel')->insert($data);
    }
}
