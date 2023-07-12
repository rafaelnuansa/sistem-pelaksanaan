<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLJurnalPelaksanaanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jurnal_pelaksanaan' => [
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
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ],
            'keterangan' => [
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

        $this->forge->addPrimaryKey('id_jurnal_pelaksanaan');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pkl_id', 'pkl', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pkl_jurnal_pelaksanaan');
    }

    public function down()
    {
        $this->forge->dropTable('pkl_jurnal_pelaksanaan');
    }
}
