<?php

namespace App\Models;

use CodeIgniter\Model;

class KKNModel extends Model
{
    protected $table = 'kkn';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_kelompok',
        'tgl_mulai',
        'tgl_selesai',
        'tahun_akademik',
        'dosen_id',
        'prodi_id',
        'instansi_id',
        'created_at',
        'updated_at',
    ];
    
    protected $useTimestamps = true;

}
