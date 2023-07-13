<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\PKLJadwalModel;
use App\Models\PKLUjianModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class PKLJadwalController extends BaseController
{

    public function __construct()
    {
        $this->pdf = new Dompdf();
        
        $this->PKLJadwalModel = new PKLJadwalModel();
        $this->ProdiModel = new ProdiModel();
        $this->PKLUjianModel = new PKLUjianModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        
        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
            ->select('pkl_jadwal_sidang.*, mahasiswa.nim as nim,  dosen_pembimbing.*, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, dosen_penguji.nama as penguji, tempat_sidang.nama_tempat as tempat_nama')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left')
            ->join('dosen as dosen_penguji', 'dosen_penguji.id = dosen_pembimbing.dosen_id', 'left')
            ->where('pkl_jadwal_sidang.mahasiswa_id', $this->mahasiswaId)
            ->where('dosen_pembimbing.mahasiswa_id', $this->mahasiswaId)
            ->groupBy('pkl_jadwal_sidang.tanggal')
            ->get()
            ->getResultArray();

        // dd($this->mahasiswaId);
        $data = [
            'title' => 'Jadwal Sidang',
            'data' =>  $jadwal_sidang,
            'jurusan' => $this->ProdiModel->findAll(),

        ];
        return view('mahasiswa/pkl/jadwal-sidang', $data);
    }

    public function daftar()
    {
        $ujian = new PKLUjianModel();

        // $this->getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        // $this->kelompokId = $this->getKelompok->id;
        $lampiran_pembayaran = $this->request->getFile('lampiran_pembayaran');
        $lampiran_krs = $this->request->getFile('lampiran_krs');
        $lampiran_laporan = $this->request->getFile('lampiran_laporan');
        $lampiran_keterangan = $this->request->getFile('lampiran_keterangan');

        $file2 = $lampiran_pembayaran->getRandomName();
        $file3 = $lampiran_krs->getRandomName();
        $file4 = $lampiran_laporan->getRandomName();
        $file5 = $lampiran_keterangan->getRandomName();

        $lampiran_pembayaran->move('uploads/pkl/', $file2);
        $lampiran_krs->move('uploads/pkl/', $file3);
        $lampiran_laporan->move('uploads/pkl/', $file4);
        $lampiran_keterangan->move('uploads/pkl/', $file5);

        $data = [
            'nama' => session()->get('nama'),
            'lampiran_pembayaran' => $file2,
            'lampiran_krs' => $file3,
            'lampiran_laporan' => $file4,
            'lampiran_keterangan' => $file5,
            'mahasiswa_id' => session()->get('mahasiswa_id')
        ];

        $ujian->insert($data);

        session()->setFlashdata('success', 'Berhasil melakukan pendaftaran');
        return redirect()->to('/mahasiswa/pkl/jadwal');
    }
}
