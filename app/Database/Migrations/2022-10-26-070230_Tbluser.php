<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbluser extends Migration
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
			'displayname'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'username'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
				'unique'         => true,
			],
			'password'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'email'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'id_level'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true
			],
            'created_at'    => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
			'isLogin'          => [
				'type'           => 'INT',
				'constraint'     => 1,
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
        $this->forge->addForeignKey('id_level', 'tbllevel', 'id');

		// Membuat tabel news
		$this->forge->createTable('tbluser', TRUE);
    }

    public function down()
    {
        $this->forge->dropForeignKey('tbllevel', 'id');
		$this->forge->dropTable('tbluser');
    }
}
