<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLJurnalPelaksanaanModel extends Model
{ 
    protected $table = 'pkl_jurnal_pelaksanaan';
    protected $primaryKey = 'id_jurnal_pelaksanaan';
    protected $allowedFields = ['mahasiswa_id', 'jam', 'hari', 'keterangan', 'pkl_id', 'status'];
    
    // Mengambil data jurnal pelaksanaan beserta data mahasiswa dan pkl terkait
    public function getJurnalPelaksanaanByIdMahasiswa($id_mahasiswa)
    {
        $queryWithInstansi = $this->select('pkl_jurnal_pelaksanaan.*, mahasiswa.*, pkl.*, instansi.nama_perusahaan as nama_perusahaan, instansi.alamat as alamat_perusahaan')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_pelaksanaan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_pelaksanaan.pkl_id')
            ->join('instansi', 'instansi.id = pkl.instansi_id', 'left')
            ->orderBy('pkl_jurnal_pelaksanaan.hari', 'asc')
            ->orderBy('pkl_jurnal_pelaksanaan.jam', 'asc')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->where('pkl.instansi_id >', 0)
            ->get()
            ->getResultArray();
    
        $queryWithoutInstansi = $this->select('pkl_jurnal_pelaksanaan.*, mahasiswa.*, pkl.*, "" as nama_perusahaan, "" as alamat_perusahaan', false)
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_pelaksanaan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_pelaksanaan.pkl_id')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->where('pkl.instansi_id', 0)
            ->get()
            ->getResultArray();
    
        return array_merge($queryWithInstansi, $queryWithoutInstansi);
    }
    

    public function getJurnalPelaksanaanByIdMahasiswaCount($id_mahasiswa)
    {
        $query = $this->select('pkl_jurnal_pelaksanaan.*, mahasiswa.*, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_pelaksanaan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_pelaksanaan.pkl_id')
            ->where('mahasiswa_id', $id_mahasiswa);

        return $query;
    }

    // Mengambil data jurnal pelaksanaan beserta data mahasiswa dan pkl terkait
    public function getJurnalPelaksanaanWithRelations()
    {
        $query = $this->select('pkl_jurnal_pelaksanaan.*, mahasiswa.*, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_pelaksanaan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_pelaksanaan.pkl_id')
            ->get();

        return $query->getResultArray();
    }

}
