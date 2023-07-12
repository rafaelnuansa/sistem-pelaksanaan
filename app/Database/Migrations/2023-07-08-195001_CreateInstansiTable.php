<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInstansiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_perusahaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'pembimbing_lapangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'no_pembimbing_lapangan' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
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
        $this->forge->createTable('instansi');
    }

    public function down()
    {
        $this->forge->dropTable('instansi');
    }
}
