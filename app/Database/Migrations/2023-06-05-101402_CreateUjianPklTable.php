<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUjianPklTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ujian_pkl' => [
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
            'user_id' => [
                'type'       => 'BIGINT'
            ]
        ]);
        $this->forge->addKey('id_ujian_pkl', true, true);
        $this->forge->createTable('ujian_pkl');
    }

    public function down()
    {
        $this->forge->dropTable('ujian_pkl');
    }
}
