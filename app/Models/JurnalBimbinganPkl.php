<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalBimbinganPkl extends Model
{
    protected $table            = 'jurnal_bimbingan_pkl';
    protected $primaryKey       = 'id_jurnal';
    protected $allowedFields    = [
        'tanggal',
        'jam',
        'nama_mhs',
        'catatan',
        'kelompok',
        'status'
    ];

    public function getAll()
    {
        $result = $this->db->table('jurnal_bimbingan_pkl')
            ->join('jurusan', 'jurnal_bimbingan_pkl.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();

        return $result;
    }
}
