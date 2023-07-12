<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurnalPelaksanaanKknTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jurnal' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'nama_mhs' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ],
            'keterangan' => [
                'type'       => 'TEXT'
            ]
        ]);
        $this->forge->addKey('id_jurnal', true, true);
        $this->forge->createTable('jurnal_pelaksanaan_kkn');
    }

    public function down()
    {
        $this->forge->dropTable('jurnal_pelaksanaan_kkn');
    }
}
