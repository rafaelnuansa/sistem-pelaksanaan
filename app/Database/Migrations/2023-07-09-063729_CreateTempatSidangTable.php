<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTempatSidangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tempat' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addPrimaryKey('id_tempat');
        $this->forge->createTable('tempat_sidang');
    }

    public function down()
    {
        $this->forge->dropTable('tempat_sidang');
    }
}
