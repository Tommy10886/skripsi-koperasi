<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbltagihan extends Migration
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
            'customer_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true
			],
            'tagihan_tahun'          => [
				'type'           => 'INT',
				'constraint'     => 4,
			],
            'tagihan_bulan'          => [
				'type'           => 'INT',
				'constraint'     => 2,
			],
            'tagihan_nilai'          => [
				'type'           => 'INT',
				'constraint'     => 12,
			],
			'tagihan_status'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'tagihan_bank'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'tagihan_va_number'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 150
			],
			'order_id_midtrans'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 150
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
        $this->forge->addForeignKey('customer_id', 'tblcustomer', 'id');

		// Membuat tabel news
		$this->forge->createTable('tbltagihan', TRUE);
    }

    public function down()
    {
        $this->forge->dropForeignKey('tblcustomer', 'id');
		$this->forge->dropTable('tbltagihan');
    }
}
