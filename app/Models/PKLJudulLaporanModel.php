<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLJudulLaporanModel extends Model
{
   
    protected $table            = 'pkl_judul_laporan';
    protected $primaryKey       = 'id_judul_laporan';
    protected $allowedFields    = ['judul_laporan', 'mahasiswa_id'];

    public function getJudulLaporanMahasiswaSesssionID($mahasiswa_id)
    {
        return "";
    }
}
