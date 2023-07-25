<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\PKLJadwalModel;
use App\Models\PKLJurnalBimbinganModel;
use App\Models\PKLNilaiModel;
use App\Models\ProdiModel;
use App\Models\TempatModel;
use Dompdf\Dompdf;

class SkripsiController extends BaseController
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

        // dd($this->dosenId);
        $mahasiswaBimbingan = $this->PKLJurnalBimbingan->getMahasiswaBimbingan($this->dosenId);
        $data = [
            'title' => 'Validasi Bimbingan',
            'data' => $mahasiswaBimbingan
        ];
        return view('dosen/skripsi/bimbingan', $data);
    }

    public function validasi_penguji()
    {
        $data = [
            'title' => 'Validasi Penguji',
            'data' => $this->PKLJurnalBimbingan->dosenGetJurnalBimbinganByDospengId($this->dosenId),
        ];
        return view('dosen/skripsi/bimbingan', $data);
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

        return view('dosen/skripsi/bimbingan-detail', $data);
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
        $result = $this->db->table('skripsi_jurnal_binbingan')
            ->where('id_jurnal', $this->request->getVar('id'))
            ->join('jurusan', 'skripsi_jurnal_binbingan.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($result[0]);
    }

    public function jadwal_skripsi()
    {
        $jadwal_sidang = $this->db->table('skripsi_sidang')
            ->select('skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospeng.nama as dospeng, dospem.nama as dospem, tempat_sidang.nama_tempat as tempat_nama, skripsi.id as skripsi_id, skripsi_nilai_sidang.*, mahasiswa.id as mahasiswa_id, skripsi.id as skripsi_id')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
            ->join('dosen as dospeng', 'dospeng.id = skripsi_sidang.dospeng_id', 'left')
            ->join('skripsi_nilai_sidang', 'skripsi_nilai_sidang.mahasiswa_id = mahasiswa.id', 'left')
            ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen as dospem', 'dospem.id = skripsi.dosen_id', 'left')
            ->where('skripsi_sidang.dospeng_id', $this->dosenId)
            ->get()
            ->getResultArray();
        // dd($jadwal_sidang);

        $data = [
            'title' => 'Jadwal Sidang Ujian',
            'data' => $jadwal_sidang,
            'dosenId' => $this->dosenId,
        ];

        // dd($jadwal_sidang);

        return view('dosen/skripsi/jadwal-sidang', $data);
    }


    public function nilai()
    {
        $PKLNilaiModel = new PKLNilaiModel();
        $mahasiswa_id = $this->request->getVar('mahasiswa_id');
        $skripsi_id = $this->request->getVar('skripsi_id');
        $dosen_id = $this->request->getVar('dosen_id');
        $sidang_id = $this->request->getVar('sidang_id');
        $catatan = $this->request->getVar('catatan');

        // Check if the record already exists in the database
        $existingRecord = $PKLNilaiModel->where('sidang_id', $sidang_id)
            ->first();

        // Retrieve the values from the request and calculate the total_nilai and other fields
        $nilai_sikap = $this->request->getVar('nilai_sikap');
        $nilai_penyajian_materi = $this->request->getVar('nilai_penyajian_materi');
        $nilai_pendahuluan = $this->request->getVar('nilai_pendahuluan');
        $nilai_tinjauan_pustaka = $this->request->getVar('nilai_tinjauan_pustaka');
        $nilai_hasil_pembahasan = $this->request->getVar('nilai_hasil_pembahasan');
        $nilai_kesimpulan_dan_saran = $this->request->getVar('nilai_kesimpulan_dan_saran');
        $nilai_daftar_pustaka = $this->request->getVar('nilai_daftar_pustaka');
        $nilai_argumentasi_penyaji = $this->request->getVar('nilai_argumentasi_penyaji');
        $nilai_penguasaan_materi = $this->request->getVar('nilai_penguasaan_materi');
        $status_ujian = $this->request->getVar('status_ujian');

        // Calculate the total_nilai based on the provided values
        $total_nilai = ($nilai_sikap +
            $nilai_penyajian_materi +
            $nilai_pendahuluan +
            $nilai_tinjauan_pustaka +
            $nilai_hasil_pembahasan +
            $nilai_kesimpulan_dan_saran +
            $nilai_daftar_pustaka +
            $nilai_argumentasi_penyaji +
            $nilai_penguasaan_materi
        );

        // Determine the nilai_mutu based on the total_nilai
        if ($total_nilai >= 80.00) {
            $nilai_mutu = 'A';
            $status_ujian = true; // Set status ujian to "Lulus"
        } elseif ($total_nilai >= 75.00) {
            $nilai_mutu = 'AB';
            $status_ujian = true; // Set status ujian to "Lulus"
        } elseif ($total_nilai >= 70.00) {
            $nilai_mutu = 'B';
            $status_ujian = true; // Set status ujian to "Lulus"
        } elseif ($total_nilai >= 65.00) {
            $nilai_mutu = 'BC';
            $status_ujian = true; // Set status ujian to "Lulus"
        } elseif ($total_nilai >= 60.00) {
            $nilai_mutu = 'C';
            $status_ujian = true; // Set status ujian to "Lulus"
        } elseif ($total_nilai >= 56.00) {
            $nilai_mutu = 'CD';
            $status_ujian = false; // Set status ujian to "Tidak Lulus"
        } elseif ($total_nilai >= 46.00) {
            $nilai_mutu = 'D';
            $status_ujian = false; // Set status ujian to "Tidak Lulus"
        } else {
            $nilai_mutu = 'E';
            $status_ujian = false; // Set status ujian to "Tidak Lulus"
        }

        // Prepare data for insert/update
        $data = [
            'mahasiswa_id' => $mahasiswa_id,
            'skripsi_id' => $skripsi_id,
            'dosen_id' => $dosen_id,
            'sidang_id' => $sidang_id,
            'nilai_sikap' => $nilai_sikap,
            'nilai_penyajian_materi' => $nilai_penyajian_materi,
            'nilai_pendahuluan' => $nilai_pendahuluan,
            'nilai_tinjauan_pustaka' => $nilai_tinjauan_pustaka,
            'nilai_hasil_pembahasan' => $nilai_hasil_pembahasan,
            'nilai_kesimpulan_dan_saran' => $nilai_kesimpulan_dan_saran,
            'nilai_daftar_pustaka' => $nilai_daftar_pustaka,
            'nilai_argumentasi_penyaji' => $nilai_argumentasi_penyaji,
            'nilai_penguasaan_materi' => $nilai_penguasaan_materi,
            'catatan' => $catatan,
            'total_nilai' => $total_nilai,
            'nilai_mutu' => $nilai_mutu,
            'status_ujian' => $status_ujian,
        ];

        // dd($data);
        // Check if the record exists, then perform insert/update accordingly
        if ($existingRecord) {
            // If the record exists, update it
            $PKLNilaiModel->update($existingRecord['id_nilai'], $data);
        } else {
            // If the record does not exist, insert it
            $PKLNilaiModel->insert($data);
        }

        session()->setFlashdata('success', 'Berhasil dinilai');

        return redirect()->back();
    }


    public function cetak($sidang_id)
    {
        $PKLNilaiModel = new PKLNilaiModel();

        // Fetch the data from the database based on the $sidang_id
        $data = $PKLNilaiModel
            ->select('skripsi_nilai_sidang.*, fakultas.nama as fakultas, prodi.nama_prodi as prodi, dosen.nama as nama_dosen, skripsi.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, skripsi_judul_laporan.judul_laporan as judul_laporan, tempat_sidang.nama_tempat as tempat_nama, dosen.nama as dospeng, dosen.nidn as nidn, skripsi_jadwal_sidang.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_nilai_sidang.mahasiswa_id')
            ->join('dosen', 'dosen.id = skripsi_nilai_sidang.dosen_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
            ->join('skripsi_anggota', 'skripsi_anggota.mahasiswa_id = mahasiswa.id')
            ->join('skripsi', 'skripsi.id = skripsi_anggota.skripsi_id')
            ->join('skripsi_judul_laporan', 'skripsi_judul_laporan.mahasiswa_id = mahasiswa.id')
            ->join('skripsi_jadwal_sidang', 'skripsi_jadwal_sidang.id_skripsi_jadwal_sidang  = skripsi_nilai_sidang.sidang_id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat  = skripsi_jadwal_sidang.tempat_id')
            ->where('sidang_id', $sidang_id)
            ->get()->getRow();
        // dd($data);
        if (!$data) {
            // If data not found, you can show an error message or redirect back
            return redirect()->back()->with('error', 'Data not found.');
        }
        // load HTML content
        $this->pdf->loadHtml(view('pdf/penilaian_skripsi', ['data' => $data]));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Laporan', array("Attachment" => false));
    }

    public function jadwal_skripsi_bimbingan()
    {
        $jadwal_sidang = $this->db->table('skripsi_jadwal_sidang')
            ->select('skripsi_jadwal_sidang.*, mahasiswa.nim as nim, dosen.nama as nama, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_jadwal_sidang.mahasiswa_id', 'left')
            ->join('skripsi_anggota', 'skripsi_anggota.mahasiswa_id = mahasiswa.id')
            ->join('skripsi', 'skripsi.id = skripsi_anggota.skripsi_id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_jadwal_sidang.tempat_id', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id', 'left')
            ->where('dosen_pembimbing.dosen_id', $this->dosenId)
            ->where('skripsi.dosen_id', $this->dosenId)
            ->get()
            ->getResultArray();
        $data = [
            'title' => 'Jadwal Sidang Mahasiswa Bimbingan',
            'data' => $jadwal_sidang
        ];

        return view('dosen/skripsi/jadwal-sidang-bim', $data);
    }

    public function approve_bimbingan()
    {
        $id_jurnal_bimbingan = $this->request->getVar('id');

        $data = $this->PKLJurnalBimbingan->where('id_jurnal_bimbingan', $id_jurnal_bimbingan)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Telah divalidasi';
        $this->PKLJurnalBimbingan->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil divalidasi');
        return redirect()->back();
    }

    public function reset_bimbingan()
    {
        $id_jurnal_bimbingan = $this->request->getVar('id');

        $data = $this->PKLJurnalBimbingan->where('id_jurnal_bimbingan', $id_jurnal_bimbingan)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Menunggu Validasi';
        $this->PKLJurnalBimbingan->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil direset');
        return redirect()->back();
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

    public function update_status_jadwal($id_skripsi_jadwal_sidang, $status)
    {
        // Contoh menggunakan model
        $this->PKLJadwal->update($id_skripsi_jadwal_sidang, ['status' => $status]);
        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }
}
