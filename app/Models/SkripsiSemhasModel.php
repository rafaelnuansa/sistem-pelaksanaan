<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiSemhasModel extends Model
{
    protected $table = 'skripsi_semhas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'mahasiswa_id',
        'transkrip_nilai',
        'krs',
        'sertifikat_seminar_kompetensi',
        'nota_dinas_pembimbing',
        'kartu_bimbingan_skripsi',
        'kartu_peserta_seminar_proposal',
        'sertifikat_mampram_ospek',
        'sertifikat_outbound',
        'sertifikat_toefl',
        'status',
    ];

    protected $useTimestamps = true; // If you have created_at and updated_at fields, set this to true.
    protected $createdField  = 'created_at'; // Change this to match your actual created_at field name.
    protected $updatedField  = 'updated_at'; // Change this to match your actual updated_at field name.

    public function pending()
    {
        return $this->select('mahasiswa.*, skripsi.*, skripsi_semhas.*, dospem.nama as dospem_nama, dospem.id as dospem_id')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_semhas.mahasiswa_id', 'left')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem', 'dospem.id = skripsi.dosen_id', 'left')
            ->where('skripsi_semhas.status', 'pending')
            ->findAll();
    }
}
