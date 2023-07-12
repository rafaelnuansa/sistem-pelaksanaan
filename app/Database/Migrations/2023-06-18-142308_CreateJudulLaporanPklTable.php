<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJudulLaporanPklTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'user_id' => [
                'type'       => 'BIGINT'
            ]
        ]);
        $this->forge->addKey('id_laporan', true, true);
        $this->forge->createTable('judul_laporan_pkl');
    }

    public function down()
    {
        $this->forge->dropTable('judul_laporan_pkl');
    }
}
