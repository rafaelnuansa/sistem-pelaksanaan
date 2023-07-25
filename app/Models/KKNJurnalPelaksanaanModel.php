<?php

namespace App\Models;

use CodeIgniter\Model;

class KKNJurnalPelaksanaanModel extends Model
{ 
    protected $table = 'kkn_jurnal_pelaksanaan';
    protected $primaryKey = 'id_jurnal_pelaksanaan';
    protected $allowedFields = ['mahasiswa_id', 'jam', 'hari', 'keterangan', 'kkn_id', 'status'];
    
    // Mengambil data jurnal pelaksanaan beserta data mahasiswa dan kkn terkait
    public function getJurnalPelaksanaanByIdMahasiswa($id_mahasiswa)
    {
        $queryWithInstansi = $this->select('kkn_jurnal_pelaksanaan.*, mahasiswa.*, kkn.*, kkn_lokasi.nama_lokasi as nama_lokasi, kkn_lokasi.alamat_lokasi as alamat_lokasi')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id')
            ->join('kkn_lokasi', 'kkn_lokasi.id = kkn.lokasi_id', 'left')
            ->orderBy('kkn_jurnal_pelaksanaan.hari', 'asc')
            ->orderBy('kkn_jurnal_pelaksanaan.jam', 'asc')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->where('kkn.lokasi_id >', 0)
            ->get()
            ->getResultArray();
    
        $queryWithoutInstansi = $this->select('kkn_jurnal_pelaksanaan.*, mahasiswa.*, kkn.*, "" as nama_lokasi, "" as alamat_perusahaan', false)
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->where('kkn.lokasi_id', 0)
            ->get()
            ->getResultArray();
    
        return array_merge($queryWithInstansi, $queryWithoutInstansi);
    }
    

    public function getJurnalPelaksanaanByIdMahasiswaCount($id_mahasiswa)
    {
        $query = $this->select('kkn_jurnal_pelaksanaan.*, mahasiswa.*, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id')
            ->where('mahasiswa_id', $id_mahasiswa);

        return $query;
    }

    // Mengambil data jurnal pelaksanaan beserta data mahasiswa dan kkn terkait
    public function getJurnalPelaksanaanWithRelations()
    {
        $query = $this->select('kkn_jurnal_pelaksanaan.*, mahasiswa.*, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id')
            ->get();

        return $query->getResultArray();
    }

 
    public function getMahasiswaPelaksanaan($dosen_id)
    {
        $query = $this->select('kkn_jurnal_pelaksanaan.*, prodi.nama_prodi as nama_prodi, mahasiswa.*, kkn.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('kkn.dosen_id', $dosen_id)
            ->orderBy('kkn_jurnal_pelaksanaan.hari', 'DESC')
            ->orderBy('kkn_jurnal_pelaksanaan.jam', 'DESC')
            ->groupBy('mahasiswa.id')
            ->get();

        return $query->getResultArray();
    }

    
    public function dosenGetJurnalDanMahasiswaPelaksanaan($mahasiswa_id)
    {
        $query = $this->select('kkn_jurnal_pelaksanaan.*, mahasiswa.*, kkn.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id')
            ->where('kkn_jurnal_pelaksanaan.mahasiswa_id', $mahasiswa_id)
            ->get();
        return $query;
    }
}
