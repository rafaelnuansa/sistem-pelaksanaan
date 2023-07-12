<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDosenPembimbingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dospem' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dosen_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'mahasiswa_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'jenis_pembimbing' => [
                'type' => 'ENUM',
                'constraint' => ['PKL', 'KKN', 'SKRIPSI'],
                'default' => 'PKL',
            ],
        ]);

        $this->forge->addPrimaryKey('id_dospem');
        $this->forge->addForeignKey('dosen_id', 'dosen', 'id');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id');
        $this->forge->createTable('dosen_pembimbing');
    }

    public function down()
    {
        $this->forge->dropTable('dosen_pembimbing');
    }
}
