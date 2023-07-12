<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeteranganKelompokSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tgl_mulai' => '2023-06-01',
                'tgl_selesai' => '2023-06-30',
                'dospem' => 'Yusuf Yudhistira, M.Kom',
                'prodi' => 'Sistem Informasi',
                'tahun_akademik' => '2023',
                'kelompok' => 1
            ],
            [
                'tgl_mulai' => '2023-06-01',
                'tgl_selesai' => '2023-06-30',
                'dospem' => 'Mukrodin, M.Kom',
                'prodi' => 'Informatika',
                'tahun_akademik' => '2023',
                'kelompok' => 2
            ],
            [
                'tgl_mulai' => '2023-06-01',
                'tgl_selesai' => '2023-06-30',
                'dospem' => 'Achmad Syauqi, M.Kom',
                'prodi' => 'Sistem Informasi',
                'tahun_akademik' => '2023',
                'kelompok' => 3
            ],
        ];

        $this->db->table('keterangan_kelompok_pkl')->insertBatch($data);
    }

    
}
