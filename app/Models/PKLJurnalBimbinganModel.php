<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLJurnalBimbinganModel extends Model
{
 
    protected $table = 'pkl_jurnal_bimbingan';
    protected $primaryKey = 'id_jurnal_bimbingan';
    protected $allowedFields = ['mahasiswa_id', 'jam', 'tanggal', 'catatan', 'pkl_id', 'status'];
    
    
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


      public function dosenGetJurnalDanMahasiswaBimbingan($mahasiswa_id)
      {
        $query = $this->select('pkl_jurnal_bimbingan.*, mahasiswa.*, pkl.*, mahasiswa.nama as nama_mahasiswa')
              ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id')
              ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id')
              ->where('pkl_jurnal_bimbingan.mahasiswa_id', $mahasiswa_id)
              ->get();
  
          return $query;
      }
}
 