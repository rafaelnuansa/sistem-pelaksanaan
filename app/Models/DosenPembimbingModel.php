<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenPembimbingModel extends Model
{
    protected $table            = 'dosen_pembimbing';
    protected $primaryKey       = 'id_dospem';
    protected $allowedFields    = [
        'dosen_id',
        'mahasiswa_id',
        'jenis_pembimbing',
    ];

    public function getDospemWithDosenMahasiswaNama()
    {
        $query = $this->select('dosen_pembimbing.*, dosen.nama as nama_dosen, dosen.nidn as nidn_dosen, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim_mahasiswa')
        ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id')
        ->join('mahasiswa', 'mahasiswa.id = dosen_pembimbing.mahasiswa_id')
        ->get();
        return $query->getResultArray();
    }
 
    public function getMahasiswaBimbinganPKLbyDosenId($dosenId)
    {
        $query = $this->select('dosen_pembimbing.*, pkl.*, dosen.nama as nama_dosen, dosen.nidn as nidn_dosen, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim_mahasiswa,pkl.nama_kelompok as nama_kelompok, ')
        ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id')
        ->join('mahasiswa', 'mahasiswa.id = dosen_pembimbing.mahasiswa_id')
        ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->where('dosen_pembimbing.dosen_id', $dosenId)
        ->where('dosen_pembimbing.jenis_pembimbing', 'PKL')
        ->get();
        return $query->getResultArray();
    }
    
}
