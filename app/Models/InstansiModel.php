<?php

namespace App\Models;

use CodeIgniter\Model;

class InstansiModel extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_perusahaan',
        'alamat',
        'pembimbing_lapangan',
        'no_pembimbing_lapangan',
        'created_at',
        'updated_at'
    ];
}
