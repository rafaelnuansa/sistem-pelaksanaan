<?php

namespace App\Models;

use CodeIgniter\Model;

class JudulLaporanPkl extends Model
{
    protected $table            = 'judul_laporan_pkl';
    protected $primaryKey       = 'id_laporan';
    protected $allowedFields    = ['judul', 'user_id'];
}
