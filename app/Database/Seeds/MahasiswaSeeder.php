<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nim' => '42139005',
                'nama' => 'Asih Tri Indriyani',
                'email' => null,
                'password' => password_hash('password1', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2000-10-01',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 1
            ],
            [
                'nim' => '42319001',
                'nama' => 'kharisma desti p',
                'email' => null,
                'password' => password_hash('password2', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2000-10-01',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 1
            ],
            [
                'nim' => '42319002',
                'nama' => 'Azis maulana',
                'email' => null,
                'password' => password_hash('password3', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2002-07-05',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 2
            ],
            [
                'nim' => '42319003',
                'nama' => 'Nina Melani',
                'email' => null,
                'password' => password_hash('password4', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2002-09-10',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 2
            ], 
            [
                'nim' => '4239004',
                'nama' => 'Rifta Rismayasari',
                'email' => null,
                'password' => password_hash('password5', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2000-10-01',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 2
            ],
            [
                'nim' => '42319006',
                'nama' => 'Shodik Abdul ghofar',
                'email' => null,
                'password' => password_hash('password6', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2000-10-01',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 3
            ],
            [
                'nim' => '42319008',
                'nama' => 'M. Wildan ihsani',
                'email' => null,
                'password' => password_hash('password7', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2000-10-01',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 1
            ],
            [
                'nim' => '42319010',
                'nama' => 'Deskal Dwi Rayananda',
                'email' => null,
                'password' => password_hash('password8', PASSWORD_DEFAULT),
                'jenis_kelamin' => 'P',
                'no_telpon' => '085436788098',
                'tgl_lahir' => '2000-10-01',
                'alamat' => 'Bumiayu',
                'angkatan' => '2019',
                'status_akun' => 1,
                'status_pkl' => 'layak',
                'prodi_id' => 1
            ],
        ];

        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
