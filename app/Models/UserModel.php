<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'username',
        'nama',
        'email',
        'password',
        'level',
        'status_akun'
    ];

    protected $useTimestamps    = false;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $validationRules = [
        'username' => 'required',
        'nama' => 'required',
        'email' => 'valid_email',
        'password' => 'required',
        'level' => 'required|in_list[1,2,3]',
        'status_akun' => 'required|in_list[0,1]'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
