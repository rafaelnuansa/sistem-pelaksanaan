<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiBimbinganModel extends Model
{

    protected $table = 'skripsi_bimbingan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['mahasiswa_id', 'tanggal', 'catatan', 'skripsi_id', 'status', 'is_pembimbing'];

    public function getJurnalBimbinganByIdMahasiswa($id_mahasiswa)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->orderBy('skripsi_bimbingan.tanggal', 'asc')
            ->where('skripsi.mahasiswa_id', $id_mahasiswa)
            ->get();
 
        return $query->getResultArray();
    }

    public function getPembimbing1($id_mahasiswa)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->orderBy('skripsi_bimbingan.tanggal', 'asc')
            ->where('skripsi.mahasiswa_id', $id_mahasiswa)
            ->where('is_pembimbing', 1)
            ->get();
 
        return $query->getResultArray();
    }
    public function getPembimbing2($id_mahasiswa)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->orderBy('skripsi_bimbingan.tanggal', 'asc')
            ->where('skripsi.mahasiswa_id', $id_mahasiswa)
            ->where('is_pembimbing', 2)
            ->get();
 
        return $query->getResultArray();
    }
    // Mengambil data jurnal bimbingan beserta data mahasiswa dan skripsi terkait
    public function getJurnalBimbinganByIdMahasiswaold($id_mahasiswa)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->get();

        return $query->getResultArray();
    }

    // Mengambil data jurnal bimbingan beserta data mahasiswa dan skripsi terkait
    public function getJurnalBimbinganWithRelations()
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalBimbingan()
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalBimbinganByDosenId($dosenId)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            //   ->join('skripsi_jadwal_sidang', 'skripsi_jadwal_sidang.dospeng_id = skripsi.skripsi_id')
            ->where('skripsi.dosen_id', $dosenId)
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalBimbinganByDospengId($dosenId)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->join('skripsi_jadwal_sidang', 'skripsi_jadwal_sidang.mahasiswa_id = mahasiswa.id')
            ->where('skripsi_jadwal_sidang.dospeng_id', $dosenId)
            ->get();

        return $query->getResultArray();
    }

    public function getMahasiswaBimbinganPKLbyDosenId($dosenId)
    {
        $query = $this->select('skripsi_bimbingan.*, dosen_pembimbing.*, skripsi.*, dosen.nama as nama_dosen, dosen.nidn as nidn_dosen, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim_mahasiswa,skripsi.nama_kelompok as nama_kelompok')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
        ->join('skripsi_anggota', 'skripsi_anggota.mahasiswa_id = mahasiswa.id')
        ->join('skripsi', 'skripsi.id = skripsi_anggota.skripsi_id')
        ->join('dosen', 'dosen.id = skripsi.dosen_id')
        ->where('skripsi.dosen_id', $dosenId)
        ->get();
        return $query->getResultArray();
    }
    
    public function getMahasiswaBimbingan($dosen_id)
    {
        $query = $this->select('skripsi_bimbingan.*, prodi.nama_prodi as nama_prodi, mahasiswa.*, skripsi.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('skripsi.dosen_id', $dosen_id)
            ->groupBy('mahasiswa.id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalDanMahasiswaBimbingan($mahasiswa_id)
    {
        $query = $this->select('skripsi_bimbingan.*, mahasiswa.*, skripsi.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_bimbingan.mahasiswa_id')
            ->join('skripsi', 'skripsi.id = skripsi_bimbingan.skripsi_id')
            ->where('skripsi_bimbingan.mahasiswa_id', $mahasiswa_id)
            ->get();

        return $query;
    }
}
