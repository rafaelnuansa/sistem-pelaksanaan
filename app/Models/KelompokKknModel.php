<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokKknModel extends Model
{
    protected $table            = 'kelompok_kkn';
    protected $primaryKey       = 'id_kelompok';
    protected $allowedFields    = [
        'nama_mhs',
        'nim',
        'dospem',
        'tempat_kkn',
        'kelompok',
        'id_jurusan'
    ];
}
