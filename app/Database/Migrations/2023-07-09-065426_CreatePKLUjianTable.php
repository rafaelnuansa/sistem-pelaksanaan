<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLUjianTable extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_pkl_ujian' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'lampiran_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'lampiran_krs' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'lampiran_laporan' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'lampiran_keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'Pending'
            ],
            'mahasiswa_id' => [
                'type'       => 'BIGINT',
                'unsigned'       => true
            ]
        ]);
 
        $this->forge->addKey('id_pkl_ujian', true);
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pkl_ujian');
    }

    public function down()
    {
        //
    }
}
