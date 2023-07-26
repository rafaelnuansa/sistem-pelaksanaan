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
        $query = $this->select('mahasiswa.*, prodi.nama_prodi, pkl.*, mahasiswa.id as mhs_id, instansi.nama_perusahaan as nama_perusahaan, instansi.alamat as alamat_perusahaan, dospem.nama as dospem')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
            ->join('dosen as dospem', 'dospem.id = pkl.dosen_id')
            ->join('instansi', 'instansi.id = pkl.instansi_id', 'left')
            ->get();
        return $query->getResultArray();
    }

    public function getMahasiswaBimbingan($dosen_id)
    {
        $query = $this->select('mahasiswa.*, mahasiswa.id as mahasiswa_id,, prodi.nama_prodi as nama_prodi, mahasiswa.*, pkl.*, mahasiswa.nama as nama_mahasiswa')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('pkl.dosen_id', $dosen_id)
            ->groupBy('mahasiswa.id')
            ->get()->getResultArray();
        // dd($query);
        return $query;
    }

    public function getMahasiswaBimbinganKKN($dosen_id)
    {
        $query = $this->select('mahasiswa.*, mahasiswa.id as mahasiswa_id, prodi.nama_prodi as nama_prodi, mahasiswa.*, kkn.*, mahasiswa.nama as nama_mahasiswa')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('kkn.dosen_id', $dosen_id)
            ->groupBy('mahasiswa.id')
            ->get()->getResultArray();
        // dd($query);
        return $query;
    }

    
    public function getMahasiswaBimbinganSkripsi($dosen_id)
    {
        $query = $this->select('mahasiswa.*, mahasiswa.id as mahasiswa_id, prodi.nama_prodi as nama_prodi, mahasiswa.*, skripsi.*, mahasiswa.nama as nama_mahasiswa')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('skripsi.dosen_id', $dosen_id)
            ->groupBy('mahasiswa.id')
            ->get()->getResultArray();
        // dd($query);
        return $query;
    }

    public function getMahasiswaHasKKN()
    {
        $query = $this->select('mahasiswa.*, prodi.nama_prodi, kkn.*, mahasiswa.id as mhs_id, kkn_lokasi.nama_lokasi as nama_lokasi, kkn_lokasi.alamat_lokasi as alamat_lokasi, dospem.nama as dospem')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id')
            ->join('dosen as dospem', 'dospem.id = kkn.dosen_id')
            ->join('kkn_lokasi', 'kkn_lokasi.id = kkn.lokasi_id', 'left')
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
