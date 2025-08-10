<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblnotifwa extends Migration
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
			'wa_title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'wa_desc'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'notif_date'      => [
                'type'          => 'INT',
				'constraint'     => 5,
			],
			'notif_tempo'      => [
                'type'          => 'INT',
				'constraint'     => 5,
			],
			'active'      => [
                'type'          => 'INT',
				'constraint'     => 1,
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
		$this->forge->createTable('tblnotifwa', TRUE);
    }

    public function down()
    {
		$this->forge->dropTable('tblnotifwa');
    }
}
