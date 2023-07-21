<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLJurnalBimbinganModel extends Model
{

    protected $table = 'pkl_jurnal_bimbingan';
    protected $primaryKey = 'id_jurnal_bimbingan';
    protected $allowedFields = ['mahasiswa_id', 'tanggal', 'catatan', 'pkl_id', 'status'];


    // Mengambil data jurnal bimbingan beserta data mahasiswa dan pkl terkait
    public function getJurnalBimbinganByIdMahasiswa($id_mahasiswa)
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->get();

        return $query->getResultArray();
    }

    // Mengambil data jurnal bimbingan beserta data mahasiswa dan pkl terkait
    public function getJurnalBimbinganWithRelations()
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalBimbingan()
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalBimbinganByDosenId($dosenId)
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            //   ->join('pkl_jadwal_sidang', 'pkl_jadwal_sidang.dospeng_id = pkl.pkl_id')
            ->where('pkl.dosen_id', $dosenId)
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalBimbinganByDospengId($dosenId)
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            ->join('pkl_jadwal_sidang', 'pkl_jadwal_sidang.mahasiswa_id = mahasiswa.id')
            ->where('pkl_jadwal_sidang.dospeng_id', $dosenId)
            ->get();

        return $query->getResultArray();
    }

    public function getMahasiswaBimbinganPKLbyDosenId($dosenId)
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, dosen_pembimbing.*, pkl.*, dosen.nama as nama_dosen, dosen.nidn as nidn_dosen, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim_mahasiswa,pkl.nama_kelompok as nama_kelompok')
        ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
        ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->join('dosen_pembimbing', 'dosen_pembimbing.dosen_id = pkl.dosen_id')
        ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id')
        ->where('dosen_pembimbing.dosen_id', $dosenId)
        ->where('dosen_pembimbing.jenis_pembimbing', 'PKL')
        ->get();
        return $query->getResultArray();
    }
    
    public function getMahasiswaBimbingan($dosen_id)
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, prodi.nama_prodi as nama_prodi, mahasiswa.*, pkl.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            ->join('dosen_pembimbing', 'dosen_pembimbing.dosen_id = pkl.dosen_id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('dosen_pembimbing.dosen_id', $dosen_id)
            ->groupBy('mahasiswa.id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalDanMahasiswaBimbingan($mahasiswa_id)
    {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
            ->where('pkl_jurnal_bimbingan.mahasiswa_id', $mahasiswa_id)
            ->get();

        return $query;
    }
}
