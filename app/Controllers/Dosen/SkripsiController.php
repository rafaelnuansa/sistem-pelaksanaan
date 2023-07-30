<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\SkripsiJurnalBimbinganModel;
use App\Models\SkripsiNilaiModel;
use App\Models\ProdiModel;
use App\Models\SkripsiSidangModel;
use App\Models\TempatModel;
use Dompdf\Dompdf;

class SkripsiController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->db = \Config\Database::connect();
        $this->SkripsiJurnalBimbingan = new SkripsiJurnalBimbinganModel();
        $this->ProdiModel = new ProdiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->SkripsiJadwal = new SkripsiSidangModel();
        $this->DosenModel = new DosenModel();
        $this->dosenId = session()->get('dosen_id');
        $this->TempatModel = new TempatModel();
    }

    public function index()
    {
        $mahasiswaBimbingan = $this->MahasiswaModel->getMahasiswaBimbinganSkripsi($this->dosenId);
        $data = [
            'title' => 'Validasi Bimbingan',
            'data' => $mahasiswaBimbingan
        ];
        return view('dosen/skripsi/bimbingan', $data);
    }

    public function bimbingan_detail($mahasiswa_id)
    {
        $rows = $this->SkripsiJurnalBimbingan->getDetailBimbinganSkripsi($mahasiswa_id);
        $mhs = $this->MahasiswaModel->where('id', $mahasiswa_id)->get()->getRow();
        $data = [
            'title' => "Jurnal Bimbingan " . $mhs->nama,
            'data' => $rows
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

    public function jadwal_skripsi()
    {
        $jadwal_sidang = $this->db->table('skripsi_sidang')
            ->select('skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, dospeng.nama as dospeng, dospem.nama as dospem, tempat_sidang.nama_tempat as tempat_nama, skripsi.id as skripsi_id, skripsi_nilai.*, mahasiswa.id as mahasiswa_id, skripsi.id as skripsi_id')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
            ->join('dosen as dospeng', 'dospeng.id = skripsi_sidang.dospeng_id', 'left')
            ->join('skripsi_nilai', 'skripsi_nilai.mahasiswa_id = mahasiswa.id', 'left')
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

    public function sempro()
    {
        $jadwal_sidang = $this->db->table('skripsi_sidang')
        ->select('skripsi_sidang.id as idz, skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, 
                  penguji1.nama as nama_penguji_1, penguji2.nama as nama_penguji_2, pembimbing1.nama as nama_pembimbing_1, pembimbing2.nama as nama_pembimbing_2,
                  tempat_sidang.nama_tempat as tempat_nama, skripsi.id as skripsi_id, 
                  skripsi_nilai_penilai_1.n1a as n1a_penilai_1, skripsi_nilai_penilai_1.n1b as n1b_penilai_1, skripsi_nilai_penilai_1.n1c as n1c_penilai_1,
                  skripsi_nilai_penilai_1.n1d as n1d_penilai_1, skripsi_nilai_penilai_1.n1e as n1e_penilai_1, skripsi_nilai_penilai_1.n1f as n1f_penilai_1,
                  skripsi_nilai_penilai_1.n2a as n2a_penilai_1, skripsi_nilai_penilai_1.n2b as n2b_penilai_1, skripsi_nilai_penilai_1.total as total_penilai_1,
                  skripsi_nilai_penilai_2.n1a as n1a_penilai_2, skripsi_nilai_penilai_2.n1b as n1b_penilai_2, skripsi_nilai_penilai_2.n1c as n1c_penilai_2,
                  skripsi_nilai_penilai_2.n1d as n1d_penilai_2, skripsi_nilai_penilai_2.n1e as n1e_penilai_2, skripsi_nilai_penilai_2.n1f as n1f_penilai_2,
                  skripsi_nilai_penilai_2.n2a as n2a_penilai_2, skripsi_nilai_penilai_2.n2b as n2b_penilai_2, skripsi_nilai_penilai_2.total as total_penilai_2,
                  skripsi_nilai_penilai_3.n1a as n1a_penilai_3, skripsi_nilai_penilai_3.n1b as n1b_penilai_3, skripsi_nilai_penilai_3.n1c as n1c_penilai_3,
                  skripsi_nilai_penilai_3.n1d as n1d_penilai_3, skripsi_nilai_penilai_3.n1e as n1e_penilai_3, skripsi_nilai_penilai_3.n1f as n1f_penilai_3,
                  skripsi_nilai_penilai_3.n2a as n2a_penilai_3, skripsi_nilai_penilai_3.n2b as n2b_penilai_3, skripsi_nilai_penilai_3.total as total_penilai_3,
                  skripsi_nilai_penilai_4.n1a as n1a_penilai_4, skripsi_nilai_penilai_4.n1b as n1b_penilai_4, skripsi_nilai_penilai_4.n1c as n1c_penilai_4,
                  skripsi_nilai_penilai_4.n1d as n1d_penilai_4, skripsi_nilai_penilai_4.n1e as n1e_penilai_4, skripsi_nilai_penilai_4.n1f as n1f_penilai_4,
                  skripsi_nilai_penilai_4.n2a as n2a_penilai_4, skripsi_nilai_penilai_4.n2b as n2b_penilai_4, skripsi_nilai_penilai_4.total as total_penilai_4,
                  mahasiswa.id as mahasiswa_id, skripsi.id as skripsi_id')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
        ->join('dosen as penguji1', 'penguji1.id = skripsi_sidang.penguji_1_id', 'left')
        ->join('dosen as penguji2', 'penguji2.id = skripsi_sidang.penguji_2_id', 'left')
        ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen as pembimbing1', 'pembimbing1.id = skripsi.pembimbing_1_id', 'left')
        ->join('dosen as pembimbing2', 'pembimbing2.id = skripsi.pembimbing_2_id', 'left')
        // Join for penilai 1
        ->join('skripsi_nilai as skripsi_nilai_penilai_1', 'skripsi_nilai_penilai_1.penilai_id = skripsi_sidang.penguji_1_id', 'left')
        // Join for penilai 2
        ->join('skripsi_nilai as skripsi_nilai_penilai_2', 'skripsi_nilai_penilai_2.penilai_id = skripsi_sidang.penguji_2_id', 'left')
        // Join for penilai 3 (assuming you have a column for penilai 3's ID)
        ->join('skripsi_nilai as skripsi_nilai_penilai_3', 'skripsi_nilai_penilai_3.penilai_id = skripsi.pembimbing_1_id', 'left')
        // Join for penilai 4 (assuming you have a column for penilai 4's ID)
        ->join('skripsi_nilai as skripsi_nilai_penilai_4', 'skripsi_nilai_penilai_4.penilai_id = skripsi.pembimbing_2_id', 'left')
        ->where('skripsi_sidang.tipe_sidang', 'seminar_proposal')
        ->get()
        ->getResultArray();
    
        $nilai = $this->db->table('skripsi_nilai')
            ->select('*')
            // ->join('dosen', 'dosen.id = skripsi_nilai.penilai_id')
            ->join('skripsi_sidang', 'skripsi_sidang.id = skripsi_nilai.sidang_id')
            ->where('skripsi_nilai.penilai_id', $this->dosenId)
            ->where('skripsi_sidang.tipe_sidang', 'seminar_proposal')
            ->get()
            ->getRow();

            // dd($nilai);
        $data = [
            'title' => 'Seminar Proposal',
            'data' => $jadwal_sidang,
            'dosenId' => $this->dosenId,
            'nilai' => $nilai,
        ];
        return view('dosen/skripsi/jadwal-sidang', $data);
    }

    public function semhas()
    {
        $jadwal_sidang = $this->db->table('skripsi_sidang')
        ->select('skripsi_sidang.id as idz, skripsi_sidang.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, 
                  penguji1.nama as nama_penguji_1, penguji2.nama as nama_penguji_2, pembimbing1.nama as nama_pembimbing_1, pembimbing2.nama as nama_pembimbing_2,
                  tempat_sidang.nama_tempat as tempat_nama, skripsi.id as skripsi_id, 
                  skripsi_nilai_penilai_1.n1a as n1a_penilai_1, skripsi_nilai_penilai_1.n1b as n1b_penilai_1, skripsi_nilai_penilai_1.n1c as n1c_penilai_1,
                  skripsi_nilai_penilai_1.n1d as n1d_penilai_1, skripsi_nilai_penilai_1.n1e as n1e_penilai_1, skripsi_nilai_penilai_1.n1f as n1f_penilai_1,
                  skripsi_nilai_penilai_1.n2a as n2a_penilai_1, skripsi_nilai_penilai_1.n2b as n2b_penilai_1, skripsi_nilai_penilai_1.total as total_penilai_1,
                  skripsi_nilai_penilai_2.n1a as n1a_penilai_2, skripsi_nilai_penilai_2.n1b as n1b_penilai_2, skripsi_nilai_penilai_2.n1c as n1c_penilai_2,
                  skripsi_nilai_penilai_2.n1d as n1d_penilai_2, skripsi_nilai_penilai_2.n1e as n1e_penilai_2, skripsi_nilai_penilai_2.n1f as n1f_penilai_2,
                  skripsi_nilai_penilai_2.n2a as n2a_penilai_2, skripsi_nilai_penilai_2.n2b as n2b_penilai_2, skripsi_nilai_penilai_2.total as total_penilai_2,
                  skripsi_nilai_penilai_3.n1a as n1a_penilai_3, skripsi_nilai_penilai_3.n1b as n1b_penilai_3, skripsi_nilai_penilai_3.n1c as n1c_penilai_3,
                  skripsi_nilai_penilai_3.n1d as n1d_penilai_3, skripsi_nilai_penilai_3.n1e as n1e_penilai_3, skripsi_nilai_penilai_3.n1f as n1f_penilai_3,
                  skripsi_nilai_penilai_3.n2a as n2a_penilai_3, skripsi_nilai_penilai_3.n2b as n2b_penilai_3, skripsi_nilai_penilai_3.total as total_penilai_3,
                  skripsi_nilai_penilai_4.n1a as n1a_penilai_4, skripsi_nilai_penilai_4.n1b as n1b_penilai_4, skripsi_nilai_penilai_4.n1c as n1c_penilai_4,
                  skripsi_nilai_penilai_4.n1d as n1d_penilai_4, skripsi_nilai_penilai_4.n1e as n1e_penilai_4, skripsi_nilai_penilai_4.n1f as n1f_penilai_4,
                  skripsi_nilai_penilai_4.n2a as n2a_penilai_4, skripsi_nilai_penilai_4.n2b as n2b_penilai_4, skripsi_nilai_penilai_4.total as total_penilai_4,
                  mahasiswa.id as mahasiswa_id, skripsi.id as skripsi_id')
        ->join('mahasiswa', 'mahasiswa.id = skripsi_sidang.mahasiswa_id', 'left')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = skripsi_sidang.tempat_id', 'left')
        ->join('dosen as penguji1', 'penguji1.id = skripsi_sidang.penguji_1_id', 'left')
        ->join('dosen as penguji2', 'penguji2.id = skripsi_sidang.penguji_2_id', 'left')
        ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen as pembimbing1', 'pembimbing1.id = skripsi.pembimbing_1_id', 'left')
        ->join('dosen as pembimbing2', 'pembimbing2.id = skripsi.pembimbing_2_id', 'left')
        // Join for penilai 1
        ->join('skripsi_nilai as skripsi_nilai_penilai_1', 'skripsi_nilai_penilai_1.penilai_id = skripsi_sidang.penguji_1_id', 'left')
        // Join for penilai 2
        ->join('skripsi_nilai as skripsi_nilai_penilai_2', 'skripsi_nilai_penilai_2.penilai_id = skripsi_sidang.penguji_2_id', 'left')
        // Join for penilai 3 (assuming you have a column for penilai 3's ID)
        ->join('skripsi_nilai as skripsi_nilai_penilai_3', 'skripsi_nilai_penilai_3.penilai_id = skripsi.pembimbing_1_id', 'left')
        // Join for penilai 4 (assuming you have a column for penilai 4's ID)
        ->join('skripsi_nilai as skripsi_nilai_penilai_4', 'skripsi_nilai_penilai_4.penilai_id = skripsi.pembimbing_2_id', 'left')
        ->where('skripsi_sidang.tipe_sidang', 'seminar_hasil')
        ->get()
        ->getResultArray();
    
        // dd($jadwal_sidang);
        $nilai = $this->db->table('skripsi_nilai')
            ->select('*')
            // ->join('dosen', 'dosen.id = skripsi_nilai.penilai_id')
            ->join('skripsi_sidang', 'skripsi_sidang.id = skripsi_nilai.sidang_id')
            ->where('skripsi_nilai.penilai_id', $this->dosenId)
            ->where('skripsi_sidang.tipe_sidang', 'seminar_hasil')
            ->get()
            ->getRow();

            // dd($nilai);
        $data = [
            'title' => 'Seminar Proposal',
            'data' => $jadwal_sidang,
            'dosenId' => $this->dosenId,
            'nilai' => $nilai,
        ];
        return view('dosen/skripsi/jadwal-sidang', $data);
    }


    public function nilai()
    {
        $SkripsiNilaiModel = new SkripsiNilaiModel();
        $mahasiswa_id = $this->request->getVar('mahasiswa_id');
        $skripsi_id = $this->request->getVar('skripsi_id');
        $penilai_id = $this->dosenId;
        $sidang_id = $this->request->getVar('sidang_id');

        // Check if the record already exists in the database
        $existingRecord = $SkripsiNilaiModel->where('sidang_id', $sidang_id)
            ->first();
   
        // Retrieve the values from the request and calculate the total_nilai and other fields
        $n1a = $this->request->getVar('n1a');
        $n1b = $this->request->getVar('n1b');
        $n1c = $this->request->getVar('n1c');
        $n1d = $this->request->getVar('n1d');
        $n1e = $this->request->getVar('n1e');
        $n1f = $this->request->getVar('n1f');
        $n2a = $this->request->getVar('n2a');
        $n2b = $this->request->getVar('n2b');
        $total = $this->request->getVar('total');

        // Calculate the total_nilai based on the provided values
        $total = (
            $n1a +
            $n1b +
            $n1c +
            $n1d +
            $n1e +
            $n1f +
            $n2a +
            $n2b 
        );

        // Prepare data for insert/update
        $data = [
            'mahasiswa_id' => $mahasiswa_id,
            'skripsi_id' => $skripsi_id,
            'penilai_id' => $penilai_id,
            'sidang_id' => $sidang_id,
            'n1a' => $n1a,
            'n1b' => $n1b,
            'n1c' => $n1c,
            'n1d' => $n1d,
            'n1e' => $n1e,
            'n1f' => $n1f,
            'n2a' => $n2a,
            'n2b' => $n2b,
            'total' => $total,
        ];

        // Check if the record exists, then perform insert/update accordingly
        if ($existingRecord) {
            $SkripsiNilaiModel->update($existingRecord['id'], $data);
        } else {
            $SkripsiNilaiModel->insert($data);
        }

        session()->setFlashdata('success', 'Berhasil dinilai');
        return redirect()->back();
    }


    public function cetak($sidang_id)
    {
        $SkripsiNilaiModel = new SkripsiNilaiModel();

        // Fetch the data from the database based on the $sidang_id
        $data = $SkripsiNilaiModel
            ->select('skripsi_nilai.*, fakultas.nama as fakultas, prodi.nama_prodi as prodi, dosen.nama as nama_dosen, skripsi.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, skripsi_judul_laporan.judul_laporan as judul_laporan, tempat_sidang.nama_tempat as tempat_nama, dosen.nama as dospeng, dosen.nidn as nidn, skripsi_jadwal_sidang.*')
            ->join('mahasiswa', 'mahasiswa.id = skripsi_nilai.mahasiswa_id')
            ->join('dosen', 'dosen.id = skripsi_nilai.dosen_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
            ->join('skripsi_anggota', 'skripsi_anggota.mahasiswa_id = mahasiswa.id')
            ->join('skripsi', 'skripsi.id = skripsi_anggota.skripsi_id')
            ->join('skripsi_judul_laporan', 'skripsi_judul_laporan.mahasiswa_id = mahasiswa.id')
            ->join('skripsi_jadwal_sidang', 'skripsi_jadwal_sidang.id_skripsi_jadwal_sidang  = skripsi_nilai.sidang_id')
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
        $id = $this->request->getVar('id');

        // Cari data berdasarkan ID yang diberikan
        $data = $this->db->table('skripsi_bimbingan')->where('id', $id)->get()->getRow();

        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $updatedData = [
            'status' => 'Telah divalidasi'
        ];

        $this->db->table('skripsi_bimbingan')->where('id', $id)->update($updatedData);
        session()->setFlashdata('success', 'Jurnal berhasil divalidasi');
        return redirect()->back();
    }



    public function reset_bimbingan()
    {
        $id = $this->request->getVar('id');

        // Cari data berdasarkan ID yang diberikan
        $data = $this->db->table('skripsi_bimbingan')->where('id', $id)->get()->getRow();

        if (!$data) {
            // Data dengan ID yang diberikan tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $updatedData = [
            'status' => 'Menunggu Validasi'
        ];

        $this->db->table('skripsi_bimbingan')->where('id', $id)->update($updatedData);
        session()->setFlashdata('success', 'Status berhasil direset menjadi "Menunggu Validasi"');
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
        $this->SkripsiJadwal->update($id_skripsi_jadwal_sidang, ['status' => $status]);
        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }
}
