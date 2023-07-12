<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianPklModel extends Model
{
    protected $table            = 'ujian_pkl';
    protected $primaryKey       = 'id_ujian_pkl';
    protected $allowedFields    = [
        'nama',
        'lampiran_pembayaran',
        'lampiran_krs',
        'lampiran_laporan',
        'lampiran_keterangan',
        'status',
        'user_id'
    ];
}
