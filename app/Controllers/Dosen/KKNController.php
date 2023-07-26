<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\DosenPembimbingModel;
use App\Models\KKNJurnalMonitoringModel;
use App\Models\KKNJurnalPelaksanaanModel;
use App\Models\KKNNilaiModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;
use App\Models\TempatModel;
use Dompdf\Dompdf;

class KKNController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->db = \Config\Database::connect();
        $this->KKNJurnalMonitoring = new KKNJurnalMonitoringModel();
        $this->KKNJurnalPelaksanaan = new KKNJurnalPelaksanaanModel();
        $this->ProdiModel = new ProdiModel();
        $this->DosenModel = new DosenModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->dosenId = session()->get('dosen_id');
        $this->TempatModel = new TempatModel();
    }

    public function index()
    {
        $mahasiswaMonitoring = $this->MahasiswaModel->getMahasiswaBimbinganKKN($this->dosenId);
        $data = [
            'title' => 'Validasi Monitoring',
            'data' => $mahasiswaMonitoring
        ];
        return view('dosen/kkn/monitoring', $data);
    }

    
    public function pelaksanaan()
    { 
        $mahasiswa = $this->MahasiswaModel->getMahasiswaBimbinganKKN($this->dosenId);
        $data = [
            'title' => 'Validasi Monitoring',
            'data' => $mahasiswa
        ];
        return view('dosen/kkn/pelaksanaan', $data);
    }

    public function pelaksanaan_detail($mahasiswa_id)
    {
        $rows = $this->KKNJurnalPelaksanaan->dosenGetJurnalDanMahasiswaPelaksanaan($mahasiswa_id);
        $getDetail = $rows->getRow();
        $dataList = $rows->getResultArray();
        $data = [
            'title' => "Jurnal Pelaksanaan " . $getDetail->nama,
            'data' => $dataList
        ];

        return view('dosen/kkn/pelaksanaan-detail', $data);
    }

    public function validasi_penguji()
    {
        $data = [
            'title' => 'Validasi Penguji',
            'data' => $this->KKNJurnalMonitoring->dosenGetJurnalMonitoringByDospengId($this->dosenId),
        ];
        return view('dosen/kkn/monitoring', $data);
    }

    public function monitoring_detail($mahasiswa_id)
    {
        $rows = $this->KKNJurnalMonitoring->dosenGetJurnalDanMahasiswaMonitoring($mahasiswa_id);
        // dd($rows); 
        $getDetail = $rows->getRow();
        $dataList = $rows->getResultArray();
        $data = [
            'title' => "Jurnal Monitoring " . $getDetail->nama,
            'data' => $dataList
        ];

        return view('dosen/kkn/monitoring-detail', $data);
    }

    public function penilaian()
    {
        return view('dosen/penilaian_ujian', ['title' => 'Penilaian Ujian']);
    }

    public function penilaian2()
    {
        return view('dosen/penilaian_revisi', ['title' => 'Penilaian revisi']);
    }

    public function jadwal_kkn()
    {
        $jadwal_sidang = $this->db->table('kkn_jadwal_sidang')
            ->select('kkn_jadwal_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospeng.nama as dospeng, dospem.nama as dospem, tempat_sidang.nama_tempat as tempat_nama, kkn.id as kkn_id, kkn_nilai_sidang.*, mahasiswa.id as mahasiswa_id, kkn.id as kkn_id')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jadwal_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = kkn_jadwal_sidang.tempat_id', 'left')
            ->join('dosen as dospeng', 'dospeng.id = kkn_jadwal_sidang.dospeng_id', 'left')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('kkn_nilai_sidang', 'kkn_nilai_sidang.mahasiswa_id = mahasiswa.id', 'left')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id', 'left')
            ->join('dosen as dospem', 'dospem.id = kkn.dosen_id', 'left')
            ->where('kkn_jadwal_sidang.dospeng_id', $this->dosenId)
            ->get()
            ->getResultArray();
        // dd($jadwal_sidang);

        $data = [
            'title' => 'Jadwal Sidang Ujian',
            'data' => $jadwal_sidang,
            'dosenId' => $this->dosenId,
        ];

        // dd($jadwal_sidang);

        return view('dosen/kkn/jadwal-sidang', $data);
    }

    public function nilai()
    {
        $KKNNilaiModel = new KKNNilaiModel();
        $mahasiswa_id = $this->request->getVar('mahasiswa_id');
        $kkn_id = $this->request->getVar('kkn_id');
        $dosen_id = $this->request->getVar('dosen_id');
        $sidang_id = $this->request->getVar('sidang_id');
        $catatan = $this->request->getVar('catatan');

        // Check if the record already exists in the database
        $existingRecord = $KKNNilaiModel->where('sidang_id', $sidang_id)
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
            'kkn_id' => $kkn_id,
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
            $KKNNilaiModel->update($existingRecord['id_nilai'], $data);
        } else {
            // If the record does not exist, insert it
            $KKNNilaiModel->insert($data);
        }

        session()->setFlashdata('success', 'Berhasil dinilai');

        return redirect()->back();
    }


    public function cetak($sidang_id)
    {
        $KKNNilaiModel = new KKNNilaiModel();

        // Fetch the data from the database based on the $sidang_id
        $data = $KKNNilaiModel
            ->select('kkn_nilai_sidang.*, fakultas.nama as fakultas, prodi.nama_prodi as prodi, dosen.nama as nama_dosen, kkn.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, kkn_judul_laporan.judul_laporan as judul_laporan, tempat_sidang.nama_tempat as tempat_nama, dosen.nama as dospeng, dosen.nidn as nidn, kkn_jadwal_sidang.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_nilai_sidang.mahasiswa_id')
            ->join('dosen', 'dosen.id = kkn_nilai_sidang.dosen_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id')
            ->join('kkn_judul_laporan', 'kkn_judul_laporan.mahasiswa_id = mahasiswa.id')
            ->join('kkn_jadwal_sidang', 'kkn_jadwal_sidang.id_kkn_jadwal_sidang  = kkn_nilai_sidang.sidang_id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat  = kkn_jadwal_sidang.tempat_id')
            ->where('sidang_id', $sidang_id)
            ->get()->getRow();
        // dd($data);
        if (!$data) {
            // If data not found, you can show an error message or redirect back
            return redirect()->back()->with('error', 'Data not found.');
        }
        // load HTML content
        $this->pdf->loadHtml(view('pdf/penilaian_kkn', ['data' => $data]));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Laporan', array("Attachment" => false));
    }

    public function jadwal_kkn_monitoring()
    {
        $jadwal_sidang = $this->db->table('kkn_jadwal_sidang')
            ->select('kkn_jadwal_sidang.*, mahasiswa.nim as nim, dosen.nama as nama, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, tempat_sidang.nama_tempat as tempat_nama')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jadwal_sidang.mahasiswa_id', 'left')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = kkn_jadwal_sidang.tempat_id', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen', 'dosen.id = dosen_pembimbing.dosen_id', 'left')
            ->where('dosen_pembimbing.dosen_id', $this->dosenId)
            ->where('kkn.dosen_id', $this->dosenId)
            ->get()
            ->getResultArray();
        $data = [
            'title' => 'Jadwal Sidang Mahasiswa Monitoring',
            'data' => $jadwal_sidang
        ];

        return view('dosen/kkn/jadwal-sidang-bim', $data);
    }

    public function approve_monitoring()
    {
        $id_jurnal_monitoring = $this->request->getVar('id');

        $data = $this->KKNJurnalMonitoring->where('id_jurnal_monitoring', $id_jurnal_monitoring)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Telah divalidasi';
        $this->KKNJurnalMonitoring->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil divalidasi');
        return redirect()->back();
    }

    public function reset_monitoring()
    {
        $id_jurnal_monitoring = $this->request->getVar('id');

        $data = $this->KKNJurnalMonitoring->where('id_jurnal_monitoring', $id_jurnal_monitoring)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Menunggu Validasi';
        $this->KKNJurnalMonitoring->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil direset');
        return redirect()->back();
    }

    public function approve_pelaksanaan()
    {
        $id_jurnal_pelaksanaan = $this->request->getVar('id');

        $data = $this->KKNJurnalPelaksanaan->where('id_jurnal_pelaksanaan', $id_jurnal_pelaksanaan)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Telah divalidasi';
        $this->KKNJurnalPelaksanaan->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil divalidasi');
        return redirect()->back();
    }

    public function reset_pelaksanaan()
    {
        $id_jurnal_pelaksanaan = $this->request->getVar('id');

        $data = $this->KKNJurnalPelaksanaan->where('id_jurnal_pelaksanaan', $id_jurnal_pelaksanaan)->first();
        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data['status'] = 'Menunggu Validasi';
        $this->KKNJurnalPelaksanaan->save($data);

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

    public function update_status_jadwal($id_kkn_jadwal_sidang, $status)
    {
        // Contoh menggunakan model
        $this->KKNJadwal->update($id_kkn_jadwal_sidang, ['status' => $status]);
        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }
}
