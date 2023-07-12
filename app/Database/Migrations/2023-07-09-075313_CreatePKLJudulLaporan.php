<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLJudulLaporanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_judul_laporan' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_laporan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'mahasiswa_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_judul_laporan');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id');
        $this->forge->createTable('pkl_judul_laporan');
    }

    public function down()
    {
        $this->forge->dropTable('pkl_judul_laporan');
    }
}
