<?php

namespace App\Models;

use CodeIgniter\Model;

class KKNJurnalMonitoringModel extends Model
{

    protected $table = 'kkn_jurnal_monitoring';
    protected $primaryKey = 'id_jurnal_monitoring';
    protected $allowedFields = ['mahasiswa_id', 'tanggal', 'catatan', 'kkn_id', 'status'];

    public function getJurnalMonitoringByIdMahasiswa($id_mahasiswa)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->orderBy('kkn_jurnal_monitoring.tanggal', 'asc')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->get();
 
        return $query->getResultArray();
    }
    // Mengambil data jurnal monitoring beserta data mahasiswa dan kkn terkait
    public function getJurnalMonitoringByIdMahasiswaold($id_mahasiswa)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->where('mahasiswa_id', $id_mahasiswa)
            ->get();

        return $query->getResultArray();
    }

    // Mengambil data jurnal monitoring beserta data mahasiswa dan kkn terkait
    public function getJurnalMonitoringWithRelations()
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalMonitoring()
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalMonitoringByDosenId($dosenId)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            //   ->join('kkn_jadwal_sidang', 'kkn_jadwal_sidang.dospeng_id = kkn.kkn_id')
            ->where('kkn.dosen_id', $dosenId)
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalMonitoringByDospengId($dosenId)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->join('kkn_jadwal_sidang', 'kkn_jadwal_sidang.mahasiswa_id = mahasiswa.id')
            ->where('kkn_jadwal_sidang.dospeng_id', $dosenId)
            ->get();

        return $query->getResultArray();
    }

    public function getMahasiswaMonitoringKKNbyDosenId($dosenId)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, dosen_pembimbing.*, kkn.*, dosen.nama as nama_dosen, dosen.nidn as nidn_dosen, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim_mahasiswa,kkn.nama_kelompok as nama_kelompok')
        ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
        ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
        ->join('kkn', 'kkn.id = kkn_anggota.kkn_id')
        ->join('dosen', 'dosen.id = kkn.dosen_id')
        ->where('kkn.dosen_id', $dosenId)
        ->get();
        return $query->getResultArray();
    }
    
    public function getMahasiswaMonitoring($dosen_id)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, prodi.nama_prodi as nama_prodi, mahasiswa.*, kkn.*, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->where('kkn.dosen_id', $dosen_id)
            ->groupBy('mahasiswa.id')
            ->get();

        return $query->getResultArray();
    }

    public function dosenGetJurnalDanMahasiswaMonitoring($mahasiswa_id)
    {
        $query = $this->select('kkn_jurnal_monitoring.*, mahasiswa.*, kkn.*, mahasiswa.id as mhs_id, mahasiswa.nama as nama_mahasiswa')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id')
            ->where('kkn_jurnal_monitoring.mahasiswa_id', $mahasiswa_id)
            ->get();

        return $query;
    }
}
