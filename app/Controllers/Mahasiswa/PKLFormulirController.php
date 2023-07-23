<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\PKLAnggotaModel;
use App\Models\PKLJudulLaporanModel;
use App\Models\PKLJurnalPelaksanaanModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class PKLFormulirController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->PKLJurnalPelaksanaanModel = new PKLJurnalPelaksanaanModel();
        $this->PKLJurnalBimbinganModel = new PKLJurnalController();
        $this->ProdiModel = new ProdiModel();
        $this->JudulLaporan = new PKLJudulLaporanModel();
        $this->AnggotaModel = new PKLAnggotaModel();
        $this->getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        $this->kelompokId = $this->getKelompok->id;
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Formulir Penilaian',
        ];
        return view('mahasiswa/pkl/formulir', $data);
    }

    public function penilaian()
    {
        $title = 'Formulir Penilaian';
        // dd($this->mahasiswa_id);
        $data = $this->db->table('mahasiswa')
        ->select('mahasiswa.*, instansi.nama_perusahaan as nama_perusahaan, pkl.bimbingan_perusahaan as nama_pl')
        ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->join('instansi', 'instansi.id = pkl.instansi_id')
        ->where('mahasiswa.id', $this->mahasiswaId)->get()->getRow();
// dd($data);
        // load HTML content
        $this->pdf->loadHtml(view('pdf/formulir_penilaian', compact('data', 'title')));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4', 'potrait');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Log Harian', array("Attachment" => false));
    }

    public function log_harian()
    {
        $title = 'Log harian';
        // dd($this->mahasiswa_id);
        $data = $this->PKLJurnalPelaksanaanModel->getJurnalPelaksanaanByIdMahasiswa($this->mahasiswaId);
        $total = $this->PKLJurnalPelaksanaanModel->getJurnalPelaksanaanByIdMahasiswaCount($this->mahasiswaId)->countAllResults();

        // load HTML content
        $this->pdf->loadHtml(view('pdf/jurnal/pelaksanaan_pkl', compact('data', 'total', 'title')));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4', 'landscape');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Log Harian', array("Attachment" => false));
    }
}
