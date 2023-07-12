<?php

namespace App\Models;

use CodeIgniter\Model;

class KeteranganKelompokPkl extends Model
{
    protected $table            = 'keterangan_kelompok_pkl';
    protected $primaryKey       = 'id_keterangan';
    protected $allowedFields    = [
        'tgl_mulai',
        'tgl_selesai',
        'dospem',
        'prodi',
        'tahun_akademik',
        'kelompok'
    ];
}
