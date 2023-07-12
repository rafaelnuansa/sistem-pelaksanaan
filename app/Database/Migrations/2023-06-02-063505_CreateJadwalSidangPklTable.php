<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalSidangPklTable extends Migration
{
    public function up() {
        $this->forge->addField([
            
            'id_pkl_jadwal_sidang' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],

            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],

            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ],

            'keterangan' => [
                'type'       => 'TEXT'
            ],

            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],

            'dospem_id' => [
                'type'       => 'BIGINT',
            ],

            'dospeng_id' => [
                'type'       => 'BIGINT',
            ],
            'tempat' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'mahasiswa_id' => [
                'type'       => 'BIGINT'
            ],
        ]);
        $this->forge->addKey('id_jadwal_sidang', true, true);
        $this->forge->createTable('jadwal_sidang_pkl');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_sidang_pkl');
    }
}
