<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiPersyaratanModel extends Model
{
    protected $table            = 'skripsi_persyaratan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'mahasiswa_id',
        'kwitansi',
        'krs',
        'laporan',
        'sk_skripsi',
        'status',
    ];

    public function ujianPending()
    {
        return $this->select('mahasiswa.*, skripsi.*, skripsi_persyaratan.*, dospem.nama as dospem_nama')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_persyaratan.mahasiswa_id', 'left')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem', 'dospem.id = skripsi.dosen_id', 'left')
            ->where('skripsi_persyaratan.status', 'pending')
            ->findAll();
    }
}
