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
    public function DosenGetDetailBimbinganSkripsi($mahasiswa_id)
    {
        $dosen_id = session()->get('dosen_id');
        $query = $this->select('skripsi_bimbingan.*, skripsi_bimbingan.id as bid, mahasiswa.*, skripsi.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->where('skripsi.mahasiswa_id', $mahasiswa_id)
            ->where('skripsi_bimbingan.is_pembimbing', 1)
            ->where('skripsi.pembimbing_1_id', $dosen_id)
            ->orWhere('skripsi_bimbingan.is_pembimbing', 2)
            ->where('skripsi.pembimbing_2_id', $dosen_id);
    
        $query->orderBy('tanggal', 'asc');
    
        return $query->get()->getResultArray();
    }
}
