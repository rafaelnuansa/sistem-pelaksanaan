<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model
{
    protected $table = 'skripsi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mahasiswa_id',
        'dosen_id',
        'prodi_id',
        'judul_skripsi',
        'tgl_mulai',
        'tgl_selesai',
        'tahun_akademik',
        'created_at', 
        'updated_at',
    ];
    
    protected $useTimestamps = true;

}
