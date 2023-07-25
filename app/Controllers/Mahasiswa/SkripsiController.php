<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\SkripsiJudulLaporanModel;
use App\Models\SkripsiModel;
use App\Models\SkripsiNilaiModel;
use App\Models\ProdiModel;
use App\Models\SkripsiBimbinganModel;
use Dompdf\Dompdf;

class SkripsiController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->SkripsiJurnalBimbinganModel = new SkripsiBimbinganModel();
        $this->ProdiModel = new ProdiModel();
        $this->SkripsiJudulLaporanModel = new SkripsiJudulLaporanModel();
        $this->SkripsiModel = new SkripsiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->getSkripsi = $this->SkripsiModel->getSkripsiSessionMhs();
        // dd($this->getSkripsi);
        if ($this->getSkripsi) {
            $this->skripsiId = $this->getSkripsi->id;
        }
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getSkripsi = $this->getSkripsi;
        // Memeriksa apakah $getSkripsi mengembalikan nilai atau tidak
        if ($getSkripsi !== null) {
            $skripsiId = $getSkripsi->id;
            $dospem = $this->db->table('dosen')
                ->select('dosen.*, dosen.nama as dospem')
                ->join('skripsi', 'skripsi.dosen_id = dosen.id', 'left')
                ->join('mahasiswa', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
          
                ->where('mahasiswa.id', $this->mahasiswaId)
                ->get()
                ->getRow();

            $data = [
                'title' => 'Skripsi ',
                'dospem' => $dospem,
                'skripsi' => $getSkripsi,
                'judul_laporan' => $getSkripsi->judul_skripsi,
            ];
        } else {
            // Tindakan yang diambil jika kelompokId tidak ada atau belum punya kelompok
            $data = [
                'title' => 'Kelompok Skripsi',
                'instansi' => null,
                'kelompok' => null,
                'akun' => null,
            ];
        }

        return view('mahasiswa/skripsi/index', $data);
    }

    public function edit_judul()
    {
        $judul_skripsi = $this->request->getVar('judul_skripsi');
        
        try {
            $existingData = $this->db->table('skripsi_judul')
                ->where('mahasiswa_id', $this->mahasiswaId)
                ->where('skripsi_id', $this->skripsiId)
                ->get()
                ->getRow();
            
            if ($existingData) {
                // Jika data sudah ada, lakukan update
                $data = [
                    'judul_skripsi' => $judul_skripsi,
                ];
                $this->db->table('skripsi_judul')
                    ->where('id', $existingData->id)
                    ->update($data);
            } else {
                // Jika data belum ada, lakukan insert
                $data = [
                    'judul_skripsi' => $judul_skripsi,
                    'mahasiswa_id' => $this->mahasiswaId,
                    'skripsi_id' => $this->skripsiId,
                ];
                $this->db->table('skripsi_judul')->insert($data);
            }
    
            session()->setFlashdata('success', 'Judul berhasil disimpan!');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan judul: ' . $e->getMessage());
        }
    
        return redirect()->back();
    }
    
}
