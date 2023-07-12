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
        $query = $this->select('pkl_jurnal_pelaksanaan.*, mahasiswa.*, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_pelaksanaan.mahasiswa_id')
            ->join('pkl', 'pkl.id = pkl_jurnal_pelaksanaan.pkl_id')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->get();

        return $query->getResultArray();
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
