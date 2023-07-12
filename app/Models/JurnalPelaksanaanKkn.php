<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalPelaksanaanKkn extends Model
{
    protected $table            = 'jurnal_pelaksanaan_kkn';
    protected $primaryKey       = 'id_jurnal';
    protected $allowedFields    = [
        'hari',
        'nama_mhs',
        'keterangan'
    ];
}
