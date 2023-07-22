<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nim',
        'nama',
        'email',
        'password',
        'jenis_kelamin',
        'no_telpon',
        'tgl_lahir',
        'alamat',
        'angkatan',
        'status_akun',
        'status_pkl',
        'prodi_id'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function getMahasiswaWithProdi()
    {
        $query = $this->select('mahasiswa.*, prodi.nama_prodi')
        ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->orderBy('mahasiswa.nim', 'asc')
        ->get();
        return $query->getResultArray();
    }

    public function getMahasiswaHasPKL()
    {
        $query = $this->select('mahasiswa.*, prodi.nama_prodi, pkl.*, mahasiswa.id as mhs_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
            ->get();
        return $query->getResultArray();
    }

    public function getMahasiswaBySession()
    {
        // Ambil data sesi mahasiswa_id
        $mahasiswaId = session('mahasiswa_id');
        // Cek apakah data sesi mahasiswa_id ada
        if ($mahasiswaId) {
            // Ambil data mahasiswa berdasarkan id
            $mahasiswa = $this->find($mahasiswaId);
            return $mahasiswa;
        }
        return null; // Jika tidak ada data sesi mahasiswa_id
    }
    
}
