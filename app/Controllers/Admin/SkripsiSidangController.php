<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;
use App\Models\SkripsiSemhasModel;
use App\Models\SkripsiSemproModel;
use App\Models\SkripsiSidangModel;
use App\Models\TempatModel;

class SkripsiSidangController extends BaseController
{
    public function __construct()
    {
        $this->ProdiModel = new ProdiModel();
        $this->SkripsiSidangModel = new SkripsiSidangModel();
        $this->SkripsiSemhasModel = new SkripsiSemhasModel();
        $this->SkripsiSemproModel = new SkripsiSemproModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->TempatModel = new TempatModel();
        $this->DosenModel = new DosenModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $pendingSemhas = $this->SkripsiSemhasModel->pending();
        $pendingSempro = $this->SkripsiSemproModel->pending();
        $mahasiswa = $this->MahasiswaModel->orderBy('nama', 'ASC')->findAll();


        // Extract unique dospem_id values from the pending array
        $dospemIdsSemhas = array_unique(array_column($pendingSemhas, 'dospem_id'));
        $dospemIdsSempro = array_unique(array_column($pendingSempro, 'dospem_id'));
        // Mengambil daftar dosen kecuali dosen pembimbing (based on dospem_id from pending)
        $dosensSemhas = $this->db->table('dosen')
            ->whereNotIn('id', $dospemIdsSemhas)
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

        $dosensSempro = $this->db->table('dosen')
            ->whereNotIn('id', $dospemIdsSempro)
            ->orderBy('nama', 'ASC')
            ->get()
            ->getResultArray();

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
            'pending_semhas' => $pendingSemhas,
            'pending_sempro' => $pendingSempro,
            'dosensSemhas' => $dosensSemhas,
            'dosensSempro' => $dosensSempro,
            'tempats' => $tempats,
            'mahasiswas' => $mahasiswa,
            'jurusan' => $this->ProdiModel->findAll()
        ];
        return view('admin/skripsi/sidang', $data);
    }

    public function simpan_sempro()
    {
        try {
            $data = [
                'tanggal' => $this->request->getVar('tanggal'),
                'jam' => $this->request->getVar('jam'),
                'keterangan' => $this->request->getVar('keterangan'),
                'dospeng_id' => $this->request->getVar('dospeng_id'),
                'tempat_id' => $this->request->getVar('tempat_id'),
                'tipe_sidang' => 'seminar_proposal',
                'mahasiswa_id' => $this->request->getVar('mahasiswa_id')
            ];

            $this->SkripsiSidangModel->insert($data);
            $seminarProposal = $this->SkripsiSemproModel->find($this->request->getVar('id_daftar'));

            if ($seminarProposal) {
                $seminarProposal['status'] = 'Approved';
                $this->SkripsiSemproModel->save($seminarProposal);
            } else {
                throw new \Exception('Persyaratan tidak ditemukan.');
            }
            session()->setFlashdata('success', 'Jadwal Sidang Skripsi berhasil ditambahkan!');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function simpan_semhas()
    {
        try {
            $data = [
                'tanggal' => $this->request->getVar('tanggal'),
                'jam' => $this->request->getVar('jam'),
                'keterangan' => $this->request->getVar('keterangan'),
                'dospeng_id' => $this->request->getVar('dospeng_id'),
                'tempat_id' => $this->request->getVar('tempat_id'),
                'tipe_sidang' => 'seminar_proposal',
                'mahasiswa_id' => $this->request->getVar('mahasiswa_id')
            ];

            $this->SkripsiSidangModel->insert($data);
            $seminarProposal = $this->SkripsiSemproModel->find($this->request->getVar('id_daftar'));

            if ($seminarProposal) {
                $seminarProposal['status'] = 'Approved';
                $this->SkripsiSemproModel->save($seminarProposal);
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
