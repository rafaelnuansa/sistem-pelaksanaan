<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLModel extends Model
{
    protected $table = 'pkl';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_kelompok',
        'tgl_mulai',
        'tgl_selesai',
        'tahun_akademik',
        'dosen_id',
        'prodi_id',
        'instansi_id',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;

    // Mengambil data jurnal bimbingan beserta data mahasiswa dan pkl terkait
    public function getPKLBySessionIdMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->select('pkl.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim')
            ->join('mahasiswa', 'mahasiswa.id = pkl.mahasiswa_id')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();
        return $query->getResultArray();
    }

}
