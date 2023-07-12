<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
           
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,
            ],

            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['L', 'P'],
                'null' => true,
            ],

            'no_telpon' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],

            'tgl_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],

            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'angkatan' => [
                'type' => 'INT',
                'constraint' => 4,
            ],

            'status_akun' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1: Aktif, 0: Tidak Aktif'
            ],
            
            'status_pkl' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            
            'prodi_id' => [
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
        $this->forge->addForeignKey('prodi_id', 'prodi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
