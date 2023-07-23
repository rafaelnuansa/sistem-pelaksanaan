<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLAnggotaModel extends Model
{
    protected $table            = 'pkl_anggota';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'mahasiswa_id',
        'pkl_id',
        'is_ketua'
    ];


    public function getKelompokIdBySessionIdMhs()
{
    $mahasiswaId = session()->get('mahasiswa_id');

    $queryWithInstansi = $this->select('pkl_anggota.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, pkl.*, instansi.id as instansi_id, instansi.nama_perusahaan, instansi.alamat as alamat_perusaan')
        ->join('mahasiswa', 'mahasiswa.id = pkl_anggota.mahasiswa_id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->join('instansi', 'instansi.id = pkl.instansi_id', 'left')
        ->where('pkl_anggota.mahasiswa_id', $mahasiswaId)
        ->where('pkl.instansi_id >', 0)
        ->get()
        ->getRow();

    $queryWithoutInstansi = $this->select('pkl_anggota.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim, pkl.*, "Belum ada perusahaan" as nama_perusahaan, "" as alamat_perusahaan', false)
        ->join('mahasiswa', 'mahasiswa.id = pkl_anggota.mahasiswa_id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->where('pkl_anggota.mahasiswa_id', $mahasiswaId)
        ->where('pkl.instansi_id', 0)
        ->get()
        ->getRow();

    if ($queryWithInstansi) {
        return $queryWithInstansi;
    } else {
        return $queryWithoutInstansi;
    }
}

}
