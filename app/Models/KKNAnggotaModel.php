<?php

namespace App\Models;

use CodeIgniter\Model;

class KKNAnggotaModel extends Model
{
    protected $table            = 'kkn_anggota';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'mahasiswa_id',
        'kkn_id',
        'is_ketua'
    ];

    public function getKelompokIdBySessionIdMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->select('kkn_anggota.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_anggota.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id')
            ->where('kkn_anggota.mahasiswa_id', $mahasiswaId)
            ->get();
        return $query->getRow();
    }
}
