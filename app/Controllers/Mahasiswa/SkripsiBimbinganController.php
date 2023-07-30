<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\SkripsiBimbinganModel;
use App\Models\SkripsiJudulLaporanModel;
use App\Models\SkripsiModel;
use Dompdf\Dompdf;

class SkripsiBimbinganController extends BaseController
{

    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->ProdiModel = new ProdiModel();
        $this->JudulLaporan = new SkripsiJudulLaporanModel();
        $this->Skripsi = new SkripsiModel();
        $this->getSkripsi = $this->Skripsi->getSkripsiSessionMhs();
        if ($this->getSkripsi) {
            $this->skripsiId = $this->getSkripsi->id;
        }
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $skripsiBimbinganModel = new SkripsiBimbinganModel();
        // Ambil semua data skripsi bimbingan dari database
        $data = $skripsiBimbinganModel->where('mahasiswa_id', $this->mahasiswaId)
        ->orderBy('tanggal', 'DESC')
        ->findAll();
        
        
        $getSkripsi = $this->getSkripsi;
        // Tampilkan data skripsi bimbingan ke view index
        return view('mahasiswa/skripsi/bimbingan/index', 
        [
            'title' => 'Bimbingan Skripsi',
            'data' => $data,
            'skripsi' => $getSkripsi,
        ]
        );
    }

    public function store()
    {
        try {
            $skripsiBimbinganModel = new SkripsiBimbinganModel();

            $data = [
                'mahasiswa_id' => $this->mahasiswaId,
                'tanggal' => $this->request->getPost('tanggal'),
                'catatan' => $this->request->getPost('catatan'),
                'skripsi_id' => $this->skripsiId,
            ];

            $skripsiBimbinganModel->insert($data);

            return redirect()->to('/mahasiswa/skripsi/bimbingan')->with('success', 'Data Skripsi Bimbingan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $skripsiBimbinganModel = new SkripsiBimbinganModel();

            // Dapatkan data skripsi bimbingan yang akan diupdate dari database
            $skripsiBimbingan = $skripsiBimbinganModel->find($id);

            if (!$skripsiBimbingan) {
                return redirect()->to('/mahasiswa/skripsi/bimbingan')->with('error', 'Data Skripsi Bimbingan tidak ditemukan.');
            }

            $data = [
                'mahasiswa_id' => $this->mahasiswaId,
                'tanggal' => $this->request->getPost('tanggal'),
                'catatan' => $this->request->getPost('catatan'),
                'skripsi_id' => $this->skripsiId,
            ];

            $skripsiBimbinganModel->update($id, $data);

            return redirect()->back()->with('success', 'Data Skripsi Bimbingan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $skripsiBimbinganModel = new SkripsiBimbinganModel();

        // Dapatkan data skripsi bimbingan yang akan dihapus dari database
        $skripsiBimbingan = $skripsiBimbinganModel->find($id);

        if (!$skripsiBimbingan) {
            return redirect()->back()->with('error', 'Data Skripsi Bimbingan tidak ditemukan.');
        }

        // Hapus data skripsi bimbingan dari database
        $skripsiBimbinganModel->delete($id);

        return redirect()->back()->with('success', 'Data Skripsi Bimbingan berhasil dihapus.');
    }
}
