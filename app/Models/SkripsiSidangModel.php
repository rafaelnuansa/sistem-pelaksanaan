<?php

namespace App\Models;

use CodeIgniter\Model;
 
class SkripsiSidangModel extends Model
{
    protected $table            = 'skripsi_sidang';
    protected $primaryKey       = 'id';
    protected $allowedFields = [
        'tanggal',
        'keterangan',
        'dospeng_id',
        'tempat_id',
        'status',
        'mahasiswa_id',
    ];
    
}
