<?php

namespace App\Models;

use CodeIgniter\Model;

class Dosen extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'no_telpon', 'alamat', 'nidn'];
}
