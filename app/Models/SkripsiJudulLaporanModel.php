<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiJudulLaporanModel extends Model
{

    protected $table            = 'skripsi_judul';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['judul_Skripsi', 'skripsi_id','mahasiswa_id'];    
}
 