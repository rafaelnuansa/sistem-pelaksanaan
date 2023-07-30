<?php

namespace App\Controllers\Admin;

use App\Models\{
    DosenModel,
    MahasiswaModel,
    PKLJadwalModel,
    ProdiModel,
    PKLUjianModel,
    TempatModel,
};
use App\Controllers\BaseController;

class PKLJadwalSidangController extends BaseController
{
    public function __construct()
    {
        $this->jurusan_model = new ProdiModel();
        $this->pkl_jadwal = new PKLJadwalModel();
        $this->pkl_ujian = new PKLUjianModel();
        $this->mahasiswa = new MahasiswaModel();
        $this->tempat = new TempatModel();
        $this->dosen = new DosenModel();
        $this->db = \Config\Database::connect();
    } 

    public function index()
    {
        $pending = $this->pkl_ujian->ujianPending()->get()->getResultArray();

        // Extract unique dospem_id values from the pending array
        $dospemIds = array_unique(array_column($pending, 'dospem_id'));

        // Mengambil daftar dosen kecuali dosen pembimbing (based on dospem_id from pending)
      
            // Check if there are any dospemIds
            if (!empty($dospemIds)) {
                $dosens = $this->db->table('dosen')
                ->whereNotIn('id', $dospemIds) // Exclude dosens with dospem_id present in $pending
                ->orderBy('nama', 'ASC')
                ->get()
                ->getResultArray();
            } else {
                $dosens = $this->db->table('dosen')
                ->orderBy('nama', 'ASC')
                ->get()
                ->getResultArray();
            }

        $mahasiswa = $this->mahasiswa->orderBy('nama', 'ASC')->findAll();
        $tempats = $this->tempat->orderBy('nama_tempat', 'ASC')->findAll(); // Fetch all dosens from the database
        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
            ->select('pkl_jadwal_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospem.nama as dospem, dospeng.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama, pkl_nilai_sidang.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id', 'left')
            ->join('pkl_nilai_sidang', 'pkl_nilai_sidang.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem', 'dospem.id = pkl.dosen_id', 'left') // Join to get the supervisor (dosen pembimbing)
            ->join('dosen as dospeng', 'dospeng.id = pkl_jadwal_sidang.dospeng_id', 'left') // Join to get the examiner (dosen penguji)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Jadwal Sidang',
            'data' => $jadwal_sidang,
            'pending' => $pending,
            'dosens' => $dosens,
            'tempats' => $tempats,
            'mahasiswas' => $mahasiswa,
            'jurusan' => $this->jurusan_model->findAll()
        ];
        return view('admin/pkl/jadwal-sidang', $data);
    }

    public function mahasiswa()
    {
        $data = [
            'title' => 'Jadwal Sidang',
            'data' => $this->pkl_jadwal->where('mahasiswa_id', session()->get('id'))->findAll(),
            'jurusan' => $this->jurusan_model->findAll()
        ];

        return view('mahasiswa/pkl/jadwal-sidang', $data);
    }

    public function show()
    {
        $result = $this->db->table('pkl_ujian')
            ->where('id_pkl_ujian', $this->request->getVar('id'))
            ->join('jurusan', 'pkl_ujian.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($result[0]);
    }

    public function simpan()
    {
        $data = [
            'tanggal' => $this->request->getVar('tanggal'),
            'jam' => $this->request->getVar('jam'),
            'keterangan' => $this->request->getVar('keterangan'),
            'dospeng_id' => $this->request->getVar('dospeng_id'),
            'tempat_id' => $this->request->getVar('tempat_id'),
            'mahasiswa_id' => $this->request->getVar('mahasiswa_id')
        ];

        $this->pkl_jadwal->insert($data);

        $ujian = $this->pkl_ujian->find($this->request->getVar('id_daftar'));

        $ujian['status'] = 'Approved';

        $this->pkl_ujian->save($ujian);
        session()->setFlashdata('success', 'Jadwal berhasil ditambahkan!');
        return redirect()->to('admin/pkl/jadwal');
    }

    public function update_status($id_pkl_jadwal_sidang, $status)
    {
        // Contoh menggunakan model
        $this->pkl_jadwal->update($id_pkl_jadwal_sidang, ['status' => $status]);
        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }
}
