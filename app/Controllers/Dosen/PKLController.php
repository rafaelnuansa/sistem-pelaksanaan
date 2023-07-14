<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\PKLJadwalModel;
use App\Models\PKLJurnalBimbinganModel;
use App\Models\ProdiModel;
use App\Models\TempatModel;
use Dompdf\Dompdf;

class PKLController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->PKLJadwal = new PKLJadwalModel();
        $this->db = \Config\Database::connect();
        $this->PKLJurnalBimbingan = new PKLJurnalBimbinganModel();
        $this->ProdiModel = new ProdiModel();
        $this->PKLJadwal = new PKLJadwalModel();
        $this->DosenModel = new DosenModel();
        $this->dosenId = session()->get('dosen_id');
        $this->TempatModel = new TempatModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Validasi Bimbingan',
            'data' => $this->PKLJurnalBimbingan->dosenGetJurnalBimbinganByDosenId($this->dosenId),
        ];
        return view('dosen/pkl/bimbingan', $data); 
    } 

    public function validasi_penguji()
    {
        $data = [
            'title' => 'Validasi Penguji',
            'data' => $this->PKLJurnalBimbingan->dosenGetJurnalBimbinganByDospengId($this->dosenId),
        ];
        return view('dosen/pkl/bimbingan', $data); 
    } 

    public function bimbingan_detail($mahasiswa_id)
    {
        $rows = $this->PKLJurnalBimbingan->dosenGetJurnalDanMahasiswaBimbingan($mahasiswa_id);
        // dd($rows); 
        $getDetail = $rows->getRow();
        $dataList = $rows->getResultArray();
        $data = [
            'title' => "Jurnal Bimbingan " . $getDetail->nama,
            'data' => $dataList
        ];

        return view('admin/pkl/jurnal/bimbingan-detail', $data);
    }

    public function penilaian()
    {
        return view('dosen/penilaian_ujian', ['title' => 'Penilaian Ujian']);
    }

    public function penilaian2()
    {
        return view('dosen/penilaian_revisi', ['title' => 'Penilaian revisi']);
    }

    public function detail()
    {
        $result = $this->db->table('pkl_jurnal_binbingan')
            ->where('id_jurnal', $this->request->getVar('id'))
            ->join('jurusan', 'pkl_jurnal_binbingan.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($result[0]);
    }
 
    public function jadwal_pkl()
    { 
        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
        ->select('pkl_jadwal_sidang.*, mahasiswa.nim as nim, dosen.nama as nama, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama')
        ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
        ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left')
        ->where('pkl_jadwal_sidang.dospeng_id', $this->dosenId)
        ->get()
        ->getResultArray();
         $data = [
            'title' => 'Jadwal Sidang Ujian',
            'data' => $jadwal_sidang
        ];
    
        return view('dosen/pkl/jadwal-sidang', $data);
    }
    
    public function jadwal_pkl_bimbingan()
    { 
        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
        ->select('pkl_jadwal_sidang.*, mahasiswa.nim as nim, dosen.nama as nama, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama')
        ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
        ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left')
        ->where('dosen_pembimbing.dosen_id', $this->dosenId)
        ->get()
        ->getResultArray();
         $data = [
            'title' => 'Jadwal Sidang Mahasiswa Bimbingan',
            'data' => $jadwal_sidang
        ];
    
        return view('dosen/pkl/jadwal-sidang-bim', $data);
    }

    public function approve_bimbingan()
    {
        $data = $this->PKLJurnalBimbingan->where('id_jurnal', $_GET['id'])->first();

        $data['status'] = 'Approved';

        $this->PKLJurnalBimbingan->save($data);

        session()->setFlashdata('success', 'Berhasil di approve');

        return redirect()->to('/dosen');
    }
 
    public function cetak()
    {
        $nilai = $this->request->getVar('nilai');
        $total_nilai = 0;
    
        foreach ($nilai as $v) {
            $total_nilai += (int)$v;
        }
    
        $data = [
            'nama_mhs' => $this->request->getVar('nama_mhs'),
            'nim' => $this->request->getVar('nim'),
            'jurusan' => $this->request->getVar('jurusan'),
            'tahun' => $this->request->getVar('tahun'),
            'judul_skripsi' => $this->request->getVar('judul_skripsi'),
            'komentar' => $this->request->getVar('komentar'),
            'nama_penguji' => $this->request->getVar('nama_penguji'),
            'nidn' => $this->request->getVar('nidn'),
            'tempat_tanggal' => $this->request->getVar('tempat_tanggal'),
            'nilai' => $nilai,
            'total_nilai' => $total_nilai,
        ];
    
        // Load HTML content
        $html = view('pdf/penilaian_pkl', ['data' => $data]);
        
        // Generate PDF
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4');
        $this->pdf->render();
        
        // Output the generated PDF
        $output = $this->pdf->output();
        $response = new \CodeIgniter\HTTP\Response($output);
        $response->setHeader('Content-Type', 'application/pdf');
        return $response->setHeader('Content-Disposition', 'inline; filename="Laporan.pdf"');
    }
    

    public function cetak_revisi()
    {
        $bab = $this->request->getVar('bab[]');
        $uraian = $this->request->getVar('uraian[]');

        // load HTML content
        $this->pdf->loadHtml(view('pdf/lembar_revisi', compact('bab', 'uraian')));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Laporan', array("Attachment" => false));
    }

    public function update_status_jadwal($id_pkl_jadwal_sidang, $status)
    {
        // Contoh menggunakan model
        $this->PKLJadwal->update($id_pkl_jadwal_sidang, ['status' => $status]);
        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }
}
