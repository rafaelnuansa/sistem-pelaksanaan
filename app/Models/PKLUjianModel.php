<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLUjianModel extends Model
{
    protected $table            = 'pkl_ujian';
    protected $primaryKey       = 'id_pkl_ujian';
    protected $allowedFields    = [
        'nama',
        'lampiran_pembayaran',
        'lampiran_krs',
        'lampiran_laporan',
        'lampiran_keterangan',
        'status',
        'mahasiswa_id'
    ];

    public function ujianPending()
    {
        return $this->select('mahasiswa.*, pkl.*, pkl_ujian.*, pkl_anggota.*, dosen.nama as dospem_nama')
            ->join('mahasiswa', 'mahasiswa.id = pkl_ujian.mahasiswa_id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id', 'left')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id', 'left')
            ->where('pkl_ujian.status', 'pending')
            ->findAll();
    }
    
    
    
}
