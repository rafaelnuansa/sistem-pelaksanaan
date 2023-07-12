<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kelompok' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'tgl_mulai' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
            ],
            'tgl_selesai' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
            ],
            'tahun_akademik' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'dosen_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'prodi_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'instansi_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('instansi_id', 'instansi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dosen_id', 'dosen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('prodi_id', 'prodi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pkl');
    }

    public function down()
    {
        $this->forge->dropTable('pkl');
    }
}
