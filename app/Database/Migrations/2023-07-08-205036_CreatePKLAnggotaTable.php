<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLAnggotaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'mahasiswa_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'pkl_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'is_ketua' => [
                'type' => 'BOOLEAN'
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
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pkl_id', 'pkl', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pkl_anggota');
    }

    public function down()
    {
        $this->forge->dropTable('pkl_anggota');
    }
}
