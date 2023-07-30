<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiNilaiModel extends Model
{
    protected $table = 'skripsi_nilai';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'skripsi_id',
        'sidang_id',
        'mahasiswa_id',
        'penilai_id',
        'n1a',
        'n1b',
        'n1c',
        'n1d',
        'n1e',
        'n1f',
        'n2a',
        'n2b',
        'total',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
