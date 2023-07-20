<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_prodi', 'fakultas_id'];

    public function fakultas()
    {
        return $this->belongsTo(FakultasModel::class, 'fakultas_id');
    }
}
