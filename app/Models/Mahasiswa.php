<?php

namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id_mahasiswa';
    protected $allowedFields    = [
        'nama',
        'no_telpon',
        'nim',
        'alamat',
        'jenis_kelamin',
        'tgl_lahir',
        'angkatan',
        'status_pkl',
        'id_jurusan',
    ];
}
