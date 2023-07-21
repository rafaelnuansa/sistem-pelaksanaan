<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table            = 'berkas';
    protected $primaryKey       = 'id_berkas';
    protected $allowedFields    = [
        'file',
        'nama_file',
        'jenis',
        'keterangan',
        'tanggal',
        'mahasiswa_id'
    ];
}
