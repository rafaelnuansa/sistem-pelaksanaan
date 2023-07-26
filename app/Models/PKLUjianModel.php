<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLUjianModel extends Model
{
    protected $table            = 'pkl_ujian';
    protected $primaryKey       = 'id_pkl_ujian';
    protected $allowedFields    = [
        'nama',
        'kwitansi',
        'krs',
        'laporan',
        'sk_pkl',
        'status',
        'mahasiswa_id'
    ];

    public function ujianPending()
    {
        return $this->select('mahasiswa.*, pkl.*, pkl_ujian.*, pkl_anggota.*, dospem.nama as dospem_nama, dospem.id as dospem_id')
            ->join('mahasiswa', 'mahasiswa.id = pkl_ujian.mahasiswa_id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id', 'left')
            ->join('dosen as dospem', 'dospem.id = pkl.dosen_id', 'left')
            ->where('pkl_ujian.status', 'pending');
    }
    
    
    
}
