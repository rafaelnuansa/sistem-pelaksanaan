<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokPklModel extends Model
{
    protected $table            = 'kelompok_pkl';
    protected $primaryKey       = 'id_kelompok';
    protected $allowedFields    = [
        'nama_mhs', 
        'nim', 
        'kelompok', 
        'id_jurusan', 
        'status', 
        'id_instansi_pkl',
        'tahun_akademik',
        'angkatan',
        'aktif',
        'keterangan'
    ];
}
