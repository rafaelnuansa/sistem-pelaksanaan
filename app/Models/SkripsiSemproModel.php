<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiSemproModel extends Model
{
    protected $table = 'skripsi_sempro';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'mahasiswa_id',
        'transkrip_nilai',
        'krs',
        'sertifikat_seminar_kompetensi',
        'nota_dinas_pembimbing',
        'kartu_bimbingan_skripsi',
        'kartu_peserta_seminar_proposal',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $dateFormat = 'datetime'; // Change this if you want to use a different date format in the database.

    public function pending()
    {
        return $this->select('mahasiswa.*, skripsi.*, skripsi_sempro.*, dospem.nama as dospem_nama, dospem.id as dospem_id')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_sempro.mahasiswa_id', 'left')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem', 'dospem.id = skripsi.dosen_id', 'left')
            ->where('skripsi_sempro.status', 'pending')
            ->findAll();
    }
}
