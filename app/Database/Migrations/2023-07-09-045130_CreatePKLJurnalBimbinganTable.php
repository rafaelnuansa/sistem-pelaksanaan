<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLJurnalBimbinganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jurnal_bimbingan' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true
            ],
        ]);
        
        $this->forge->addField([
            'mahasiswa_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true
            ],
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => '10'
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ],
            'catatan' => [
                'type'       => 'TEXT'
            ],
            'pkl_id' => [
                'type'       => 'BIGINT',
                'unsigned'   => true
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'default'    => 'Pending'
            ]
        ]);

        $this->forge->addPrimaryKey('id_jurnal_bimbingan');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pkl_id', 'pkl', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pkl_jurnal_bimbingan');
    }

    public function down()
    {
        $this->forge->dropTable('pkl_jurnal_bimbingan');
    }
}
