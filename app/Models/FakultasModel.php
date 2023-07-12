<?php

namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model
{
    protected $table            = 'fakultas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'nama'
    ];

    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'nama' => 'required'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public function prodi()
    {
        return $this->hasMany(ProdiModel::class, 'fakultas_id');
    }
}
