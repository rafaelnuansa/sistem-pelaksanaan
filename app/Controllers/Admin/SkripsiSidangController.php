<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;
use App\Models\SkripsiPersyaratanModel;
use App\Models\SkripsiSidangModel;
use App\Models\TempatModel;

class SkripsiSidangController extends BaseController
{
    public function __construct()
    {
        $this->ProdiModel = new ProdiModel();
        $this->SkripsiSidangModel = new SkripsiSidangModel();
        $this->SkripsiPersyaratanModel = new SkripsiPersyaratanModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->TempatModel = new TempatModel();
        $this->DosenModel = new DosenModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $pending = $this->SkripsiPersyaratanModel->ujianPending();
        $mahasiswa = $this->MahasiswaModel->orderBy('nama', 'ASC')->findAll();
        $dosens = $this->DosenModel->orderBy('nama', 'ASC')->findAll(); // Fetch all dosens from the database
        $tempats = $this->TempatModel->orderBy('nama_tempat', 'ASC')->findAll(); // Fetch all dosens from the database
        $jadwal_sidang = $this->db->table('skripsi_sidang')
        ->select('skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospem.nama as dospem, dospeng.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama, skripsi_nilai_sidang.*')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
        ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
        ->join('skripsi_nilai_sidang', 'skripsi_nilai_sidang.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen as dospem', 'dospem.id = skripsi.dosen_id', 'left') // Join to get the supervisor (dosen pembimbing)
        ->join('dosen as dospeng', 'dospeng.id = skripsi_sidang.dospeng_id', 'left') // Join to get the examiner (dosen penguji)
        ->get() 
        ->getResultArray();

        $data = [
            'title' => 'Jadwal Sidang Skripsi',
            'data' => $jadwal_sidang,
            'pending' => $pending,
            'dosens' => $dosens,
            'tempats' => $tempats,
            'mahasiswas' => $mahasiswa,
            'jurusan' => $this->ProdiModel->findAll()
        ];
        return view('admin/skripsi/sidang', $data);
    }

    public function simpan()
    {
        try {
            $data = [
                'tanggal' => $this->request->getVar('tanggal'),
                'keterangan' => $this->request->getVar('keterangan'),
                'dospeng_id' => $this->request->getVar('dospeng_id'),
                'tempat_id' => $this->request->getVar('tempat_id'),
                'mahasiswa_id' => $this->request->getVar('mahasiswa_id')
            ];
    
            $this->SkripsiSidangModel->insert($data);
    
            $persyaratan = $this->SkripsiPersyaratanModel->find($this->request->getVar('id_daftar'));
    
            if ($persyaratan) {
                $persyaratan['status'] = 'Approved';
                $this->SkripsiPersyaratanModel->save($persyaratan);
            } else {
                throw new \Exception('Persyaratan tidak ditemukan.');
            }
    
            session()->setFlashdata('success', 'Jadwal Sidang Skripsi berhasil ditambahkan!');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    
        return redirect()->back();
    }

}
