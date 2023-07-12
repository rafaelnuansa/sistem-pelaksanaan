<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembimbingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
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
            'tipe_bimbingan' => [
                'type' => 'ENUM',
                'constraint' => ['PKL', 'KKN', 'SKRIPSI'],
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
        $this->forge->addForeignKey('dosen_id', 'dosen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembimbing');
    }

    public function down()
    {
        $this->forge->dropTable('pembimbing');
    }
}
