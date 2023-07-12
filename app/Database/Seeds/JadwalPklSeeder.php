<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalPklSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tanggal' => '20-05-2023',
                'nama' => 'Dewi Anggi',
                'nim' => '10382812',
                'keterangan' => 'Sidang PKL',
                'dospem' => 'Bambang Trianto',
                'dospeng' => 'Fahru Rozi S.pd',
                'tempat' => 'Lab. Bahasa'
            ],
            [
                'tanggal' => '21-05-2023',
                'nama' => 'Dwi Wicaksono',
                'nim' => '11252800',
                'keterangan' => 'Sidang PKL',
                'dospem' => 'Rudi Ahmad M.kom',
                'dospeng' => 'Fahru Rozi S.pd',
                'tempat' => 'Lab. Komputer'
            ]
        ];

        $this->db->table('jadwal_sidang_pkl')->insertBatch($data);
    }
}
