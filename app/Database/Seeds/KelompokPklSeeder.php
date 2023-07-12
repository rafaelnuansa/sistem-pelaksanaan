<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelompokPklSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('kelompok_pkl')->insertBatch([
            [
                'nama_mhs' => 'Asih Tri Indriyani', 
                'nim' => '42139005', 
                'kelompok' => 1,
                'status' => 'Ketua',
                'id_jurusan' => 2,
                'tahun_akademik' => '2022/2023',
                'keterangan' => 'Sudah PKL',
                'aktif' => 'ya',
                'angkatan' => '2020'
            ],
            [
                'nama_mhs' => 'kharisma desti p', 
                'nim' => '42319001', 
                'kelompok' => 2,
                'status' => 'Ketua',
                'id_jurusan' => 2,
                'tahun_akademik' => '2022/2023',
                'keterangan' => 'Sudah PKL',
                'aktif' => 'ya',
                'angkatan' => '2020'
            ]
        ]);
        
        $data = [
            [
                'nama_mhs' => 'Azis maulana', 
                'nim' => '42319002', 
                'kelompok' => 3,
                'status' => 'Ketua',
                'id_jurusan' => 3,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Nina Melani', 
                'nim' => '42319003', 
                'kelompok' => 1,
                'status' => 'Anggota',
                'id_jurusan' => 2,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Rifta Rismayasari', 
                'nim' => '4239004', 
                'kelompok' => 1,
                'status' => 'Anggota',
                'id_jurusan' => 2,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'tidak'
            ],
            [
                'nama_mhs' => 'Shodik Abdul ghofar', 
                'nim' => '42319006', 
                'kelompok' => 1,
                'status' => 'Anggota',
                'id_jurusan' => 3,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'tidak'
            ],
            [
                'nama_mhs' => 'M. Wildan ihsani', 
                'nim' => '42319008', 
                'kelompok' => 1,
                'status' => 'Anggota',
                'id_jurusan' => 2,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Deskal Dwi Rayananda', 
                'nim' => '42319010', 
                'kelompok' => 2,
                'status' => 'Anggota',
                'id_jurusan' => 1,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Ahmad Munibi', 
                'nim' => '42319012', 
                'kelompok' => 2,
                'status' => 'Anggota',
                'id_jurusan' => 2,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Inayatul ulfiana', 
                'nim' => '423190013', 
                'kelompok' => 2,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'tidak'
            ],
            [
                'nama_mhs' => 'M. Rafi Syabana', 
                'nim' => '423190014', 
                'kelompok' => 2,
                'status' => 'Anggota',
                'id_jurusan' => 3,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Melly Ayu Fajriyan', 
                'nim' => '423190017', 
                'kelompok' => 3,
                'status' => 'Anggota',
                'id_jurusan' => 1,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Tedy Ega', 
                'nim' => '423190019', 
                'kelompok' => 3,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Neli Sa\'adah', 
                'nim' => '42319020', 
                'kelompok' => 3,
                'status' => 'Anggota',
                'id_jurusan' => 1,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Arum Tri Indriyana', 
                'nim' => '42319021', 
                'kelompok' => 3,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'tidak'
            ],
            [
                'nama_mhs' => 'Azkiya', 
                'nim' => '42319022', 
                'kelompok' => 4,
                'status' => 'Ketua',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Assyfa Hanum', 
                'nim' => '42319023', 
                'kelompok' => 4,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'tidak'
            ],
            [
                'nama_mhs' => 'Rizaldi M', 
                'nim' => '42319024', 
                'kelompok' => 4,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'M. Ivandi', 
                'nim' => '42319025', 
                'kelompok' => 4,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'ya'
            ],
            [
                'nama_mhs' => 'Dini Putri', 
                'nim' => '42319027', 
                'kelompok' => 4,
                'status' => 'Anggota',
                'id_jurusan' => 4,
                'tahun_akademik' => '2022/2023',
                'angkatan' => '2020',
                'aktif' => 'tidak'
            ],
        ];

        $this->db->table('kelompok_pkl')->insertBatch($data);
    }
}
