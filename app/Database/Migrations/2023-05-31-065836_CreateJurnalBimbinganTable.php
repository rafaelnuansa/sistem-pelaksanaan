<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurnalBimbinganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jurnal' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => '10'
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'nama_mhs' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'kelompok' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ],
            'catatan' => [
                'type'       => 'TEXT'
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default' => 'Pending'
            ],
        ]);
        $this->forge->addKey('id_jurnal', true, true);
        $this->forge->createTable('jurnal_bimbingan_pkl');
    }

    public function down()
    {
        $this->forge->dropTable('jurnal_bimbingan_pkl');
    }
}
