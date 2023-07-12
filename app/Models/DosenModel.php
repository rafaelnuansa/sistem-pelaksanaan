<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nidn', 'email', 'password', 'no_telpon', 'alamat', 'status_akun', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
