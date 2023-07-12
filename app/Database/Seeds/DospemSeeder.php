<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DospemSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_dosen' => 'Yusuf Yudhistira, M.Kom',
                'nama_mhs' => 'Asih Tri Indriyani',
                'nim' => '42139005',
                'keterangan' => 'Dospem PKL'
            ],
            [
                'nama_dosen' => 'Mukrodin, M.Kom',
                'nama_mhs' => 'Asih Tri Indriyani',
                'nim' => '42139005',
                'keterangan' => 'Dospem KKN'
            ],
            [
                'nama_dosen' => 'Achmad Syauqi, M.Kom',
                'nama_mhs' => 'Asih Tri Indriyani',
                'nim' => '42139005',
                'keterangan' => 'Dospem Skripsi'
            ],
            [
                'nama_dosen' => 'Fuaida Nabyla, M.Kom',
                'nama_mhs' => 'kharisma desti p',
                'nim' => '42319001',
                'keterangan' => 'Dospem PKL'
            ],
            [
                'nama_dosen' => 'Eko Sudrajat, M.Kom',
                'nama_mhs' => 'Azis maulana',
                'nim' => '42319002',
                'keterangan' => 'Dospem PKL'
            ],
            [
                'nama_dosen' => 'Danar, M.Kom',
                'nama_mhs' => 'Azis maulana',
                'nim' => '42319002',
                'keterangan' => 'Dospem KKN'
            ]
        ];

        $this->db->table('dosen_pembimbing')->insertBatch($data);
    }
}
