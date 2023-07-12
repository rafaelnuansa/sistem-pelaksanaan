<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePKLJadwalSidangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pkl_jadwal_sidang' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'dospem_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'dospeng_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'tempat_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'Pending',
            ],
            'mahasiswa_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id_pkl_jadwal_sidang', true);
        $this->forge->addForeignKey('dospem_id', 'dosen', 'id');
        $this->forge->addForeignKey('dospeng_id', 'dosen', 'id');
        $this->forge->addForeignKey('tempat_id', 'tempat_sidang', 'id_tempat');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id');

        $this->forge->createTable('pkl_jadwal_sidang');
    }

    public function down()
    {
        $this->forge->dropTable('pkl_jadwal_sidang');
    }
}
