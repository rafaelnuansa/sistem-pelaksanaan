<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanKknModel extends Model
{
    protected $table            = 'laporan_kkn';
    protected $primaryKey       = 'id_laporan';
    protected $allowedFields    = [
        'hari',
        'nama_mhs',
        'catatan',
        'id_jurusan'
    ];
}
