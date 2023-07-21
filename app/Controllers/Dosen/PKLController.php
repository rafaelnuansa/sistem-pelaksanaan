<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\DosenPembimbingModel;
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
        $this->DosenPembimbingModel = new DosenPembimbingModel();
    }

    public function index()
    {

        // dd($this->dosenId);
        $mahasiswaBimbingan = $this->PKLJurnalBimbingan->getMahasiswaBimbingan($this->dosenId);
        $data = [
            'title' => 'Validasi Bimbingan',
            'data' => $mahasiswaBimbingan
        ];
 
        // dd($mahasiswaBimbingan);

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

        return view('dosen/pkl/bimbingan-detail', $data);
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

        // dd($jadwal_sidang);

        return view('dosen/pkl/jadwal-sidang', $data);
    }

    public function jadwal_pkl_bimbingan()
    {
        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
            ->select('pkl_jadwal_sidang.*, mahasiswa.nim as nim, dosen.nama as nama, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id', 'left')
            ->where('dosen_pembimbing.dosen_id', $this->dosenId)
            ->where('pkl.dosen_id', $this->dosenId)
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
        $id_jurnal_bimbingan = $this->request->getVar('id');

        $data = $this->PKLJurnalBimbingan->where('id_jurnal_bimbingan', $id_jurnal_bimbingan)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Approved';
        $this->PKLJurnalBimbingan->save($data);

        session()->setFlashdata('success', 'Berhasil di approve');
        return redirect()->back();
    }

    public function nilai()
    {

        $PKLJadwalModel = new PKLJadwalModel();
        $id_pkl_jadwal_sidang = $this->request->getVar('id_pkl_jadwal_sidang');
        $nilai_sikap = $this->request->getVar('nilai_sikap');
        $nilai_materi = $this->request->getVar('nilai_materi');
        $nilai_pendahuluan = $this->request->getVar('nilai_pendahuluan');
        $nilai_tinjauan_pustaka = $this->request->getVar('nilai_tinjauan_pustaka');
        $nilai_pembahasan = $this->request->getVar('nilai_pembahasan');
        $nilai_kesimpulan = $this->request->getVar('nilai_kesimpulan');
        $nilai_daftar_pustaka = $this->request->getVar('nilai_daftar_pustaka');
        $nilai_argumentasi = $this->request->getVar('nilai_argumentasi');
        $nilai_penguasaan = $this->request->getVar('nilai_penguasaan');
        $komentar = $this->request->getVar('komentar');
        // Calculate the total nilai by summing all the components
        $total_nilai = $nilai_sikap + $nilai_materi + $nilai_pendahuluan + $nilai_tinjauan_pustaka + $nilai_pembahasan + $nilai_kesimpulan + $nilai_daftar_pustaka + $nilai_argumentasi + $nilai_penguasaan;

        $data = [
            'nilai_sikap' => $nilai_sikap,
            'nilai_materi' => $nilai_materi,
            'nilai_pendahuluan' => $nilai_pendahuluan,
            'nilai_tinjauan_pustaka' => $nilai_tinjauan_pustaka,
            'nilai_pembahasan' => $nilai_pembahasan,
            'nilai_kesimpulan' => $nilai_kesimpulan,
            'nilai_daftar_pustaka' => $nilai_daftar_pustaka,
            'nilai_argumentasi' => $nilai_argumentasi,
            'nilai_penguasaan' => $nilai_penguasaan,
            'total_nilai' => $total_nilai,
            'status' => 1,
            'komentar' => $komentar
        ];

        // dd($total_nilai);
        $PKLJadwalModel->update($id_pkl_jadwal_sidang, $data);
        session()->setFlashdata('success', 'Berhasil di nilai');
        return redirect()->back();
    }

    public function cetak($id)
    {
        // Fetch the data from the database based on the $id
        // $data = $PKLJadwalModel->find($id);
        $data = $this->db->table('pkl_jadwal_sidang')
        ->select('pkl_jadwal_sidang.*, pkl_judul_laporan.*, fakultas.nama as fakultas, pkl.tahun_akademik as tahun_akademik, prodi.nama_prodi as prodi, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan , dosen.nidn as nidn, dosen.nama as nama, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama')
        ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
        ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left')
        ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
        ->join('fakultas', 'fakultas.id = prodi.fakultas_id', 'left')
        ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
        ->join('pkl', 'pkl_anggota.pkl_id = pkl.id', 'left')
        ->join('pkl_judul_laporan', 'pkl_judul_laporan.mahasiswa_id = mahasiswa.id', 'left')
        ->where('pkl_jadwal_sidang.id_pkl_jadwal_sidang', $id)
        ->get()
        ->getRow();
        // dd($data);
        // If the data is not found, you can handle the error or redirect to an error page
        if (!$data) {
            return redirect()->to('/error_page');
        }

        // load HTML content
        $this->pdf->loadHtml(view('pdf/penilaian_pkl', ['data' => $data]));
    
        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4');
    
        // render html as PDF
        $this->pdf->render();
    
        // output the generated pdf
        return $this->pdf->stream('Laporan', array("Attachment" => false));
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
