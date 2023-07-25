<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model
{
    protected $table = 'skripsi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mahasiswa_id',
        'dosen_id',
        'prodi_id',
        'judul_skripsi',
        'tgl_mulai',
        'tgl_selesai',
        'tahun_akademik',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
   
    
    public function getSkripsiSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->select('skripsi.id as id, skripsi.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, skripsi_judul.judul_skripsi')
        ->join('skripsi_judul', 'skripsi.id = skripsi_judul.skripsi_id', 'left')
        ->join('mahasiswa', 'mahasiswa.id = skripsi.mahasiswa_id')
            ->where('mahasiswa.id   ', $mahasiswaId)
            ->get();
        return $query->getRow();
    }

    public function getSidangSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->db->table('skripsi_sidang')
        ->select('skripsi_sidang.*, skripsi_nilai_sidang.*, fakultas.nama as fakultas, dospem.nama as dospem, prodi.nama_prodi as prodi, dosen.nama as nama_dosen, skripsi.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, skripsi_judul.judul_skripsi as judul_skripsi, tempat_sidang.nama_tempat as tempat_nama, dosen.nama as dospeng, dosen.nidn as nidn')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id')
        ->join('dosen', 'dosen.id = skripsi_sidang.dospeng_id')
        ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
        ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
        ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id')
        ->join('dosen as dospem', 'dospem.id = skripsi.dosen_id')
        ->join('skripsi_judul', 'skripsi_judul.mahasiswa_id = mahasiswa.id')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id')
        ->join('skripsi_nilai_sidang', 'skripsi_sidang.id = skripsi_nilai_sidang.sidang_id', 'left') // Use left join instead of inner join
        ->where('skripsi_sidang.mahasiswa_id',  $mahasiswaId)
        ->groupBy('skripsi_sidang.tanggal')
        ->get()
        ->getResultArray();

        return $query;
    }
}
