<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPklModel extends Model
{
    protected $table            = 'jadwal_sidang_pkl';
    protected $primaryKey       = 'id_jadwal_sidang';
    protected $allowedFields    = [
        'tanggal',
        'nama',
        'nim',
        'keterangan',
        'dospem',
        'dospeng',
        'tempat',
        'status',
        'user_id',
    ];
}
