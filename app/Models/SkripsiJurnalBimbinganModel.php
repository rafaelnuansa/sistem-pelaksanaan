<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiJurnalBimbinganModel extends Model
{
    protected $table            = 'skripsi_bimbingan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['skripsi_id, mahasiswa_id, tanggal, catatan, status'];


    public function getDetailBimbinganSkripsi($mahasiswa_id)
    {
        $query = $this->select('skripsi_bimbingan.*, skripsi_bimbingan.id as bid, mahasiswa.*, skripsi.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->where('skripsi_bimbingan.mahasiswa_id', $mahasiswa_id)
            ->get()->getResultArray();

        return $query;
    }
}
