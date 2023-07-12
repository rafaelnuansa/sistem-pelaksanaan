<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PklSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kelompok' => 'Kelompok 1',
                'tgl_mulai' => '2023-07-01',
                'tgl_selesai' => '2023-08-07',
                'tahun_akademik' => '2023/2024',
                'prodi_id' => 1,
                'dosen_id' => 1
            ]
        ];

        $this->db->table('pkl')->insertBatch($data);
    }
}
