<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\KKNLokasiModel;
use App\Models\MahasiswaModel;
use App\Models\KKNAnggotaModel;
use App\Models\KKNJurnalMonitoringModel;
use App\Models\KKNJurnalPelaksanaanModel;
use App\Models\KKNModel;
use App\Models\KKNNilaiModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class KKNController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->KKNJurnalPelaksanaanModel = new KKNJurnalPelaksanaanModel();
        $this->KKNJurnalMonitoringModel = new KKNJurnalMonitoringModel();
        $this->ProdiModel = new ProdiModel();
        $this->KKNLokasiModel = new KKNLokasiModel();
        $this->KKNModel = new KKNModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->KKNAnggotaModel = new KKNAnggotaModel();
        $this->KKNLokasiModel = new KKNLokasiModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->getKelompok = $this->KKNAnggotaModel->getKelompokIdBySessionIdMhs();
        if ($this->getKelompok) {
            $this->kelompokId = $this->getKelompok->id;
        }
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getKelompok = $this->KKNAnggotaModel->getKelompokIdBySessionIdMhs();
        // Memeriksa apakah $getKelompok mengembalikan nilai atau tidak
        if ($getKelompok !== null) {
            $is_ketua = $getKelompok->is_ketua;
            $kelompokId = $getKelompok->id;

            // Lanjutkan dengan kode Anda yang sudah ada
            $akun = $this->KKNAnggotaModel
                ->where('mahasiswa_id', $this->mahasiswaId)
                ->first();

            $anggota = $this->KKNAnggotaModel
                ->where('kkn_id', $kelompokId)
                ->join('kkn', 'kkn_anggota.kkn_id = kkn.id')
                ->join('mahasiswa', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
                ->get()
                ->getResultArray();

            $dospem = $this->db->table('dosen')
                ->select('dosen.*, dosen.nama as dospem')
                ->join('kkn', 'kkn.dosen_id = dosen.id', 'left')
                ->join('kkn_anggota', 'kkn_anggota.kkn_id = kkn.id', 'left')
                ->join('mahasiswa', 'kkn_anggota.mahasiswa_id = mahasiswa.id', 'left')
                ->where('mahasiswa.id', $this->mahasiswaId)
                ->get()
                ->getRow();
            // dd($getKelompok);
            $lokasi = $this->KKNLokasiModel->findAll();
            // dd($lokasi);
            $data = [
                'title' => 'Kelompok KKN ',
                'anggota' => $anggota,
                'dospem' => $dospem,
                'akun' => $akun,
                'nama_kelompok' =>  $getKelompok->nama_kelompok,
                'is_ketua' => $is_ketua,
                'kelompok' => $getKelompok,
                'lokasi' => $lokasi,
            ];
        } else {
            // Tindakan yang diambil jika kelompokId tidak ada atau belum punya kelompok
            $data = [
                'title' => 'Kelompok KKN',
                'anggota' => [],
                'lokasi' => null,
                'nama_kelompok' => null,
                'akun' => null,
            ];
        }

        return view('mahasiswa/kkn/index', $data);
    }

    public function pelaksanaan()
    {

        // dd($this->kelompokId);
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'data' => $this->KKNJurnalPelaksanaanModel->where('mahasiswa_id', $this->mahasiswaId)->findAll(),
            'kelompokId' => $this->kelompokId,
        ];

        return view('mahasiswa/kkn/jurnal/pelaksanaan', $data);
    }

    public function monitoring()
    {
        $data = [
            'title' => 'Jurnal Monitoring',
            'data' => $this->KKNJurnalMonitoringModel->where('mahasiswa_id', $this->mahasiswaId)->findAll(),
        ];

        return view('mahasiswa/kkn/jurnal/monitoring', $data);
    }

    public function edit_lokasi()
    {
        $KKNModel = new KKNModel();
        $kelompokId = $this->request->getVar('kelompok_id');

        // Jika mengisi form yang freetext
        $data = [
            'lokasi_id' => $this->request->getPost('lokasi_id'),
            'nama_kepala_desa' => $this->request->getPost('nama_kepala_desa'),
            'no_kepala_desa' => $this->request->getPost('no_kepala_desa'),
        ];

        if ($KKNModel->update($kelompokId, $data)) {
            // Data updated successfully
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
        } else {
            // Failed to update data
            session()->setFlashdata('error', 'Gagal memperbarui data.');
        }

        return redirect()->to('/mahasiswa/kkn');
    }

    public function approve($id)
    {
        $data = $this->KKNJurnalPelaksanaanModel->find($id);
        $data['status'] = 'Approved';

        $this->KKNJurnalPelaksanaanModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan');
    }

    public function unapprove2($id)
    {
        $data = $this->KKNJurnalMonitoringModel->find($id);
        $data['status'] = 'Pending';

        $this->KKNJurnalMonitoringModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring');
    }

    public function approve2($id)
    {
        $data = $this->KKNJurnalMonitoringModel->find($id);
        $data['status'] = 'Approved';

        $this->KKNJurnalMonitoringModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring');
    }

    public function simpan()
    {
        $data = [
            'nama_mhs' => session()->get('nama'),
            'jam' => $this->request->getVar('jam'),
            'hari' => $this->request->getVar('hari'),
            'keterangan' => $this->request->getVar('keterangan'),
        ];

        // insert data
        $this->KKNJurnalPelaksanaanModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');

        return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan');
    }

    public function simpan2()
    {

        $data = [
            'tanggal' => $this->request->getVar('tanggal'),
            'nama_mhs' => session()->get('nama'),
            'catatan' => $this->request->getVar('keterangan'),
            'kelompok' => session()->get('kelompok')
        ];

        // insert data
        $this->KKNJurnalMonitoringModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');

        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring');
    }

    public function log_harian()
    {
        $title = 'Log harian';
        $data = $this->KKNJurnalPelaksanaanModel->where('kelompok', session()->get('kelompok'))->findAll();
        $total = $this->KKNJurnalPelaksanaanModel->where('kelompok', session()->get('kelompok'))->countAllResults();

        // load HTML content
        $this->pdf->loadHtml(view('pdf/jurnal/pelaksanaan_kkn', compact('data', 'total', 'title')));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4', 'landscape');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Log Harian', array("Attachment" => false));
    }

    public function cetak($id)
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
            ->where('sidang_id', $id)
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


    public function surat_izin_observasi()
    {

        // dd($this->kelompokId);
        $data = [
            'title' => 'Surat Izin Observasi',
        ];

        return view('mahasiswa/kkn/suratizinobservasi', $data);
    }
 
    
}
