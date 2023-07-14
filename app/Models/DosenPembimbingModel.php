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
    
}
