<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model
{
    protected $table = 'skripsi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mahasiswa_id',
        'pembimbing_1_id',
        'pembimbing_2_id',
        'prodi_id',
        'judul_skripsi',
        'tgl_mulai',
        'tgl_selesai',
        'tahun_akademik',
        'tipe_sidang',
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

    public function getSkripsiSemhasSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->select('skripsi.id as id, skripsi.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, skripsi_judul.judul_skripsi')
            ->join('skripsi_judul', 'skripsi.id = skripsi_judul.skripsi_id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = skripsi.mahasiswa_id')
            ->where('mahasiswa.id', $mahasiswaId)
            ->where('skripsi.tipe_sidang', 'seminar_hasil')
            ->get();
        return $query->getRow();
    }

    public function getSkripsiSemproSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->select('skripsi.id as id, skripsi.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, skripsi_judul.judul_skripsi')
            ->join('skripsi_judul', 'skripsi.id = skripsi_judul.skripsi_id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = skripsi.mahasiswa_id')
            ->where('mahasiswa.id', $mahasiswaId)
            ->where('skripsi.tipe_sidang', 'seminar_proposal')
            ->get();
        return $query->getRow();
    }

    public function getSidangSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->db->table('skripsi_sidang')
        ->select('skripsi_sidang.*, skripsi_nilai.*, fakultas.nama as fakultas, pembimbing1.nama as nama_pembimbing_1, pembimbing2.nama as nama_pembimbing_2, prodi.nama_prodi as prodi, skripsi.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, tempat_sidang.nama_tempat as tempat_nama,penguji1.nama as nama_penguji_1, penguji1.nidn as nidn_penguji_1, penguji2.nama as nama_penguji_2, penguji2.nidn as nidn_penguji_2')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id')
            ->join('dosen as penguji1', 'penguji1.id = skripsi_sidang.penguji_1_id')
            ->join('dosen as penguji2', 'penguji2.id = skripsi_sidang.penguji_2_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id')
            ->join('dosen as pembimbing1', 'pembimbing1.id = skripsi.pembimbing_1_id')
            ->join('dosen as pembimbing2', 'pembimbing2.id = skripsi.pembimbing_2_id')
            ->join('skripsi_judul', 'skripsi_judul.mahasiswa_id = mahasiswa.id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id')
            ->join('skripsi_nilai', 'skripsi_sidang.id = skripsi_nilai.sidang_id', 'left') // Use left join instead of inner join
            ->where('skripsi_sidang.mahasiswa_id',  $mahasiswaId)
            ->groupBy('skripsi_sidang.tanggal')
            ->get()
            ->getResultArray();

        return $query;
    }
    public function getSidangSemhasSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->db->table('skripsi_sidang')
        ->select('skripsi_sidang.*, skripsi_nilai.*, fakultas.nama as fakultas, pembimbing1.nama as nama_pembimbing_1, pembimbing2.nama as nama_pembimbing_2, prodi.nama_prodi as prodi, skripsi.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, tempat_sidang.nama_tempat as tempat_nama,penguji1.nama as nama_penguji_1, penguji1.nidn as nidn_penguji_1, penguji2.nama as nama_penguji_2, penguji2.nidn as nidn_penguji_2')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id')
            ->join('dosen as penguji1', 'penguji1.id = skripsi_sidang.penguji_1_id')
            ->join('dosen as penguji2', 'penguji2.id = skripsi_sidang.penguji_2_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id')
            ->join('dosen as pembimbing1', 'pembimbing1.id = skripsi.pembimbing_1_id')
            ->join('dosen as pembimbing2', 'pembimbing2.id = skripsi.pembimbing_2_id')
            // ->join('skripsi_judul', 'skripsi_judul.mahasiswa_id = mahasiswa.id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id')
            ->join('skripsi_nilai', 'skripsi_sidang.id = skripsi_nilai.sidang_id', 'left') // Use left join instead of inner join
            ->where('skripsi_sidang.mahasiswa_id',  $mahasiswaId)
            ->where('skripsi_sidang.tipe_sidang', 'seminar_hasil')
            ->groupBy('skripsi_sidang.tanggal')
            ->get()
            ->getResultArray();

        return $query;
    }

    public function getSidangSemproSessionMhs()
    {
        $mahasiswaId = session()->get('mahasiswa_id');
        $query = $this->db->table('skripsi_sidang')
            ->select('skripsi_sidang.*, skripsi_nilai.*, fakultas.nama as fakultas, pembimbing1.nama as nama_pembimbing_1, pembimbing2.nama as nama_pembimbing_2, prodi.nama_prodi as prodi, skripsi.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, tempat_sidang.nama_tempat as tempat_nama,penguji1.nama as nama_penguji_1, penguji1.nidn as nidn_penguji_1, penguji2.nama as nama_penguji_2, penguji2.nidn as nidn_penguji_2')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id')
            ->join('dosen as penguji1', 'penguji1.id = skripsi_sidang.penguji_1_id')
            ->join('dosen as penguji2', 'penguji2.id = skripsi_sidang.penguji_2_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id')
            ->join('dosen as pembimbing1', 'pembimbing1.id = skripsi.pembimbing_1_id')
            ->join('dosen as pembimbing2', 'pembimbing2.id = skripsi.pembimbing_2_id')
            // ->join('skripsi_judul', 'skripsi_judul.mahasiswa_id = mahasiswa.id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id')
            ->join('skripsi_nilai', 'skripsi_sidang.id = skripsi_nilai.sidang_id', 'left')
            ->where('skripsi_sidang.mahasiswa_id',  $mahasiswaId)
            ->where('skripsi_sidang.tipe_sidang', 'seminar_proposal')
            ->groupBy('skripsi_sidang.tanggal')
            ->get()
            ->getResultArray();
        // dd($query); 
        return $query;
    }
}
