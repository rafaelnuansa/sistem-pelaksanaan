<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_prodi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'fakultas_id' => [
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
        $this->forge->addForeignKey('fakultas_id', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prodi');
    }

    public function down()
    {
        $this->forge->dropTable('prodi');
    }
}
