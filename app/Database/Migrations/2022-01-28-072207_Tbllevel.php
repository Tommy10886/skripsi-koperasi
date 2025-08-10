<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbllevel extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'level_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
            'created_at'    => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'updated_at'    => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'deleted_at'    => [
                'type'          => 'DATETIME',
                'null'          => true
            ]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('tbllevel', TRUE);
    }

    public function down()
    {
		$this->forge->dropTable('tbllevel');
    }
}
