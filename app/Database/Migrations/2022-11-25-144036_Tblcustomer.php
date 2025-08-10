<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblcustomer extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'customer_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'customer_address'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'customer_phone'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
			],
			'customer_nik'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'customer_tagihan'      => [
				'type'           => 'INT',
				'constraint'     => 12,
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
		$this->forge->createTable('tblcustomer', TRUE);
    }

    public function down()
    {
		$this->forge->dropTable('tblcustomer');
    }
}
