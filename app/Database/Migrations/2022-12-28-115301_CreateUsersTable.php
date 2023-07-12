<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'null'      => true,
                'constraint' => '50'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'level' => [
                'type'       => 'TINYINT',
                'constraint' => '1'
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
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
