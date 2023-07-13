<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLAnggotaModel extends Model
{
    protected $table            = 'pkl_anggota';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'mahasiswa_id',
        'pkl_id',
        'is_ketua'
    ];


    public function getKelompokIdBySessionIdMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->select('pkl_anggota.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_anggota.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
            ->where('pkl_anggota.mahasiswa_id', $mahasiswaId)
            ->get();
        return $query->getRow();
    }
}
