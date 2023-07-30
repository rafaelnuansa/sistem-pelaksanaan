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
        $pendingSempro = $this->SkripsiSemproModel->pending();
        $mahasiswa = $this->MahasiswaModel->orderBy('nama', 'ASC')->findAll();

        // Extract unique dospem_id values from the pending array
        $dospemIdsSempro = array_unique(array_column($pendingSempro, 'dospem_id'));

        // Check if there are any dospemIdsSempro
        if (!empty($dospemIdsSempro)) {
            $dosensSempro = $this->db->table('dosen')
                ->whereNotIn('id', $dospemIdsSempro)
                ->orderBy('nama', 'ASC')
                ->get()
                ->getResultArray();
        } else {
            $dosensSempro = $this->db->table('dosen')
                ->orderBy('nama', 'ASC')
                ->get()
                ->getResultArray();
        }

        $tempats = $this->TempatModel->orderBy('nama_tempat', 'ASC')->findAll(); // Fetch all dosens from the database
        $jadwalSempro = $this->db->table('skripsi_sidang')
            ->select('skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospem1.nama as nama_pembimbing_1, dospem2.nama as nama_pembimbing_2, dospeng1.nama as nama_penguji_1, dospeng2.nama as nama_penguji_2, tempat_sidang.nama_tempat as tempat_nama, skripsi_nilai.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
            ->join('skripsi_nilai', 'skripsi_nilai.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem1', 'dospem1.id = skripsi.pembimbing_1_id', 'left') // Join to get the supervisor (dosen pembimbing)
            ->join('dosen as dospem2', 'dospem2.id = skripsi.pembimbing_2_id', 'left') // Join to get the supervisor (dosen pembimbing)
            ->join('dosen as dospeng1', 'dospeng1.id = skripsi_sidang.penguji_1_id', 'left') // Join to get the examiner (dosen penguji)
            ->join('dosen as dospeng2', 'dospeng2.id = skripsi_sidang.penguji_2_id', 'left') // Join to get the examiner (dosen penguji)
            ->where('skripsi_sidang.tipe_sidang', 'seminar_proposal')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Seminar Proposal',
            'jadwal_sempro' => $jadwalSempro,
            'pending_sempro' => $pendingSempro,
            'dosensSempro' => $dosensSempro,
            'tempats' => $tempats,
            'mahasiswas' => $mahasiswa,
            'jurusan' => $this->ProdiModel->findAll()
        ];
        return view('admin/skripsi/sempro', $data);
    }

    public function semhas()
    {
        $pendingSemhas = $this->SkripsiSemhasModel->pending();
        $mahasiswa = $this->MahasiswaModel->orderBy('nama', 'ASC')->findAll();

        // Extract unique dospem_id values from the pending array
        $dospemIdsSemhas = array_unique(array_column($pendingSemhas, 'dospem_id'));

        // Check if there are any dospem$dospemIdsSemhas
        if (!empty($dospemIdsSemhas)) {
            $dosensSemhas = $this->db->table('dosen')
                ->whereNotIn('id', $dospemIdsSemhas)
                ->orderBy('nama', 'ASC')
                ->get()
                ->getResultArray();
        } else {
            $dosensSemhas = $this->db->table('dosen')
                ->orderBy('nama', 'ASC')
                ->get()
                ->getResultArray();
        }

        $tempats = $this->TempatModel->orderBy('nama_tempat', 'ASC')->findAll(); // Fetch all dosens from the database
        $jadwalSemhas = $this->db->table('skripsi_sidang')
            ->select('skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospem1.nama as nama_pembimbing_1, dospem2.nama as nama_pembimbing_2, dospeng1.nama as nama_penguji_1, dospeng2.nama as nama_penguji_2, tempat_sidang.nama_tempat as tempat_nama, skripsi_nilai.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
            ->join('skripsi_nilai', 'skripsi_nilai.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem1', 'dospem1.id = skripsi.pembimbing_1_id', 'left') // Join to get the examiner (dosen penguji)
            ->join('dosen as dospem2', 'dospem2.id = skripsi.pembimbing_2_id', 'left') // Join to get the examiner (dosen penguji)
            ->join('dosen as dospeng1', 'dospeng1.id = skripsi_sidang.penguji_1_id', 'left') // Join to get the examiner (dosen penguji)
            ->join('dosen as dospeng2', 'dospeng2.id = skripsi_sidang.penguji_2_id', 'left') // Join to get the examiner (dosen penguji)
            ->where('skripsi_sidang.tipe_sidang', 'seminar_hasil')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Sidang Skripsi',
            'jadwal_semhas' => $jadwalSemhas,
            'pending_semhas' => $pendingSemhas,
            'dosensSemhas' => $dosensSemhas,
            'tempats' => $tempats,
            'mahasiswas' => $mahasiswa,
            'jurusan' => $this->ProdiModel->findAll()
        ];
        return view('admin/skripsi/semhas', $data);
    }

    public function simpan_sempro()
    {
        try {
            $mahasiswa_id = $this->request->getVar('mahasiswa_id');

            // Check if the Mahasiswa is already registered in the "seminar proposal" schedule
            $existingSeminar = $this->SkripsiSidangModel->where('mahasiswa_id', $mahasiswa_id)->where('tipe_sidang', 'seminar_proposal')->first();
            if ($existingSeminar) {
                throw new \Exception('Mahasiswa ini telah terdaftar dalam jadwal sidang seminar proposal.');
            }

            $data = [
                'tanggal' => $this->request->getVar('tanggal'),
                'jam' => $this->request->getVar('jam'),
                'keterangan' => $this->request->getVar('keterangan'),
                'penguji_1_id' => $this->request->getVar('penguji_1_id'),
                'penguji_2_id' => $this->request->getVar('penguji_2_id'),
                'tempat_id' => $this->request->getVar('tempat_id'),
                'tipe_sidang' => 'seminar_proposal',
                'mahasiswa_id' => $mahasiswa_id
            ];
            // Check if Penguji 1 and Penguji 2 are the same
            if ($data['penguji_1_id'] == $data['penguji_2_id']) {
                throw new \Exception('Penguji 1 dan Penguji 2 tidak boleh sama.');
            }
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
            $mahasiswa_id = $this->request->getVar('mahasiswa_id');

            // Check if the Mahasiswa is already registered in the "seminar hasil" schedule
            $existingSeminar = $this->SkripsiSidangModel->where('mahasiswa_id', $mahasiswa_id)->where('tipe_sidang', 'seminar_hasil')->first();
            if ($existingSeminar) {
                throw new \Exception('Mahasiswa ini telah terdaftar dalam jadwal sidang seminar hasil.');
            }

            $data = [
                'tanggal' => $this->request->getVar('tanggal'),
                'jam' => $this->request->getVar('jam'),
                'keterangan' => $this->request->getVar('keterangan'),
                'penguji_1_id' => $this->request->getVar('penguji_1_id'),
                'penguji_2_id' => $this->request->getVar('penguji_2_id'),
                'tempat_id' => $this->request->getVar('tempat_id'),
                'tipe_sidang' => 'seminar_hasil',
                'mahasiswa_id' => $mahasiswa_id
            ];
            // Check if Penguji 1 and Penguji 2 are the same
            if ($data['penguji_1_id'] == $data['penguji_2_id']) {
                throw new \Exception('Penguji 1 dan Penguji 2 tidak boleh sama.');
            }
            $this->SkripsiSidangModel->insert($data);

            $seminarHasil = $this->SkripsiSemhasModel->find($this->request->getVar('id_daftar'));
            if ($seminarHasil) {
                $seminarHasil['status'] = 'Approved';
                $this->SkripsiSemhasModel->save($seminarHasil);
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
