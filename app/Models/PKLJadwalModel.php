<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLJadwalModel extends Model
{
    protected $table            = 'pkl_jadwal_sidang';
    protected $primaryKey       = 'id_pkl_jadwal_sidang';
    protected $allowedFields = [
        'tanggal',
        'jam',
        'keterangan',
        'dospeng_id',
        'tempat_id',
        'komentar',
        'status',
        'mahasiswa_id',
    ];
    
}
