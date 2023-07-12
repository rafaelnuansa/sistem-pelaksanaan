<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBerkasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berkas' => [
                'type' => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'nama_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
            'jenis' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '120'
            ],
        ]);
        $this->forge->addKey('id_berkas', true, true);
        $this->forge->createTable('berkas');
    }

    public function down()
    {
        $this->forge->dropTable('berkas');
    }
}
