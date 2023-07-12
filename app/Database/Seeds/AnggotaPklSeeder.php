<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnggotaPklSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'mahasiswa_id' => 1,
                'pkl_id' => 1,
                'ketua' => true
            ],
            [
                'mahasiswa_id' => 14,
                'pkl_id' => 1,
                'ketua' => false
            ]
        ];

        $this->db->table('anggota_pkl')->insertBatch($data);
    }
}
