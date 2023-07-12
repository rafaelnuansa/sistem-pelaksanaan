<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDosenTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

            'nidn' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
                'null' => true,
            ],

            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],


            'no_telpon' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => true,
            ],

            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],

            'status_akun' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1: Aktif, 0: Tidak Aktif'
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
        $this->forge->createTable('dosen');
    }

    public function down()
    {
        $this->forge->dropTable('dosen');
    }
}
