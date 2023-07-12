<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalPelaksanaanPkl extends Model
{
    protected $table            = 'jurnal_pelaksanaan_pkl';
    protected $primaryKey       = 'id_jurnal';
    protected $allowedFields    = ['nama_mhs', 'jam', 'hari', 'keterangan', 'kelompok', 'status'];
}
