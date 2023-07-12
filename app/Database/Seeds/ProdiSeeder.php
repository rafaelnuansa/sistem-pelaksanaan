<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $fakultasModel = new \App\Models\FakultasModel();

        $fakultas = $fakultasModel->findAll();

        $data = [
            [
                'nama_prodi' => 'Teknik Informatika',
                'fakultas_id' => $fakultas[0]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_prodi' => 'Sistem Informasi',
                'fakultas_id' => $fakultas[0]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_prodi' => 'Farmasi',
                'fakultas_id' => $fakultas[1]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_prodi' => 'Agribisnis',
                'fakultas_id' => $fakultas[1]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_prodi' => 'Teknik Elektro',
                'fakultas_id' => $fakultas[2]['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Tambahkan data prodi lainnya sesuai kebutuhan
        ];

        $this->db->table('prodi')->insertBatch($data);
    }
}
