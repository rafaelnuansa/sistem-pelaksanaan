<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Fakultas Teknik',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Ekonomi',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Hukum',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Pertanian',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Ilmu Komputer',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Tambahkan data fakultas lainnya sesuai kebutuhan
        ];

        $this->db->table('fakultas')->insertBatch($data);
    }
}
