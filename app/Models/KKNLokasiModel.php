<?php

namespace App\Models;

use CodeIgniter\Model;

class KKNLokasiModel extends Model
{
    protected $table            = 'kkn_lokasi';
    protected $primaryKey       = 'id';
    protected $allowedFields = [
        'nama_lokasi',
        'alamat_lokasi',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;

    public function getAll()
    {
        $query = $this->select('kkn_lokasi.*')
            ->get();
        return $query->getResultArray();
    }
} 
