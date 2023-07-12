<?php

namespace App\Models;

use CodeIgniter\Model;

class PembimbingModel extends Model
{
    protected $table = 'pembimbing';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dosen_id', 'mahasiswa_id', 'tipe_bimbingan', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    public function dosen()
    {
        return $this->belongsTo(DosenModel::class, 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'mahasiswa_id');
    }

    public function getWithRelations()
    {
        return $this->select('pembimbing.*, dosen.nama AS dosen_nama, mahasiswa.nama AS mahasiswa_nama')
            ->join('dosen', 'dosen.id = pembimbing.dosen_id')
            ->join('mahasiswa', 'mahasiswa.id = pembimbing.mahasiswa_id')
            ->orderBy('pembimbing.created_at', 'DESC')
            ->findAll();
    }
}
