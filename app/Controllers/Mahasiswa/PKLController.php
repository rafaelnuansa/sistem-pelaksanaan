<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\InstansiModel;
use App\Models\MahasiswaModel;
use App\Models\PKLAnggotaModel;
use App\Models\PKLJudulLaporanModel;
use App\Models\PKLJurnalBimbinganModel;
use App\Models\PKLJurnalPelaksanaanModel;
use App\Models\PKLModel;
use App\Models\PKLNilaiModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class PKLController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->PKLJurnalPelaksanaanModel = new PKLJurnalPelaksanaanModel();
        $this->PKLJurnalBimbinganModel = new PKLJurnalBimbinganModel();
        $this->ProdiModel = new ProdiModel();
        $this->PKLJudulLaporanModel = new PKLJudulLaporanModel();
        $this->InstansiModel = new InstansiModel();
        $this->PKLModel = new PKLModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->AnggotaModel = new PKLAnggotaModel();
        $this->InstansiModel = new InstansiModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        if($this->getKelompok){
            $this->kelompokId = $this->getKelompok->id;
        }
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        // Memeriksa apakah $getKelompok mengembalikan nilai atau tidak
        if ($getKelompok !== null) {
            $is_ketua = $getKelompok->is_ketua;
            $kelompokId = $getKelompok->id;

            // Lanjutkan dengan kode Anda yang sudah ada
            $akun = $this->AnggotaModel
                ->where('mahasiswa_id', $this->mahasiswaId)
                ->first();

            $anggota = $this->AnggotaModel
                ->where('pkl_id', $kelompokId)
                ->join('pkl', 'pkl_anggota.pkl_id = pkl.id')
                ->join('mahasiswa', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
                ->get()
                ->getResultArray(); 
                
            $dospem = $this->db->table('dosen')
                ->select('dosen.*, dosen.nama as dospem')
                ->join('pkl', 'pkl.dosen_id = dosen.id', 'left')
                ->join('pkl_anggota', 'pkl_anggota.pkl_id = pkl.id', 'left')
                ->join('mahasiswa', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
                ->where('mahasiswa.id', $this->mahasiswaId)
                ->get()
                ->getRow();
            // dd($getKelompok);
            $instansi = $this->InstansiModel->findAll();
            // dd($instansi);
            $data = [
                'title' => 'Kelompok PKL ',
                'anggota' => $anggota,
                'dospem' => $dospem,
                'akun' => $akun,
                'nama_kelompok' =>  $getKelompok->nama_kelompok,
                'is_ketua' => $is_ketua,
                'kelompok' => $getKelompok,
                'instansi' => $instansi,
            ];
        } else {
            // Tindakan yang diambil jika kelompokId tidak ada atau belum punya kelompok
            $data = [
                'title' => 'Kelompok PKL',
                'anggota' => [],
                'instansi' => null,
                'kelompok' => null,
                'akun' => null,
            ];
        }

        return view('mahasiswa/pkl/index', $data);
    }

    public function pelaksanaan()
    {

        // dd($this->kelompokId);
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'data' => $this->PKLJurnalPelaksanaanModel->where('mahasiswa_id', $this->mahasiswa_id)->findAll(),
            'kelompokId' => $this->kelompokId,
        ];

        return view('mahasiswa/pkl/jurnal/pelaksanaan', $data);
    }

    public function bimbingan()
    {
        $judul_laporan = $this->PKLJudulLaporanModel->where('mahasiswa_id', $this->mahasiswaId)->first();

        $data = [
            'title' => 'Jurnal Bimbingan',
            'data' => $this->PKLJurnalBimbinganModel->where('mahasiswa_id', $this->mahasiswa_id)->findAll(),
            'judul_laporan' => ($judul_laporan != null) ? $judul_laporan['judul_laporan'] : null
        ];

        return view('mahasiswa/pkl/jurnal/bimbingan', $data);
    }

    public function simpan_judul()
    {

        $this->PKLJudulLaporanModel->insert([
            'judul' => $this->request->getVar('judul_laporan'),
            'user_id' => session()->get('id')
        ]);

        session()->setFlashdata('success', 'Judul berhasil disimpan!');

        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
    }

    public function edit_instansi()
    {
        $PKLModel = new PKLModel();
        $kelompokId = $this->request->getVar('kelompok_id');
    
        // Jika mengisi form yang freetext
        $data = [
            'instansi_id' => $this->request->getPost('instansi_id'),
            'bimbingan_perusahaan' => $this->request->getPost('bimbingan_perusahaan'),
            'no_perusahaan' => $this->request->getPost('no_perusahaan'),
            'jabatan_bimbingan_perusahaan' => $this->request->getPost('jabatan_bimbingan_perusahaan'),
        ];
    
        if ($PKLModel->update($kelompokId, $data)) {
            // Data updated successfully
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
        } else {
            // Failed to update data
            session()->setFlashdata('error', 'Gagal memperbarui data.');
        }
    
        return redirect()->to('/mahasiswa/pkl');
    }
    public function approve($id)
    {
        $data = $this->PKLJurnalPelaksanaanModel->find($id);
        $data['status'] = 'Approved';

        $this->PKLJurnalPelaksanaanModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan');
    }

    public function unapprove2($id)
    {
        $data = $this->PKLJurnalBimbinganModel->find($id);
        $data['status'] = 'Pending';

        $this->PKLJurnalBimbinganModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
    }

    public function approve2($id)
    {
        $data = $this->PKLJurnalBimbinganModel->find($id);
        $data['status'] = 'Approved';

        $this->PKLJurnalBimbinganModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
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
        $this->PKLJurnalPelaksanaanModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');

        return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan');
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
        $this->PKLJurnalBimbinganModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');

        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
    }

    public function log_harian()
    {
        $title = 'Log harian';
        $data = $this->PKLJurnalPelaksanaanModel->where('kelompok', session()->get('kelompok'))->findAll();
        $total = $this->PKLJurnalPelaksanaanModel->where('kelompok', session()->get('kelompok'))->countAllResults();

        // load HTML content
        $this->pdf->loadHtml(view('pdf/jurnal/pelaksanaan_pkl', compact('data', 'total', 'title')));

        // (optional) setup the paper size and orientation
        $this->pdf->setPaper('A4', 'landscape');

        // render html as PDF
        $this->pdf->render();

        // output the generated pdf
        return $this->pdf->stream('Log Harian', array("Attachment" => false));
    }

    public function cetak($id)
    {
        $PKLNilaiModel = new PKLNilaiModel();

        // Fetch the data from the database based on the $sidang_id
        $data = $PKLNilaiModel 
        ->select('pkl_nilai_sidang.*, fakultas.nama as fakultas, prodi.nama_prodi as prodi, dosen.nama as nama_dosen, pkl.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, pkl_judul_laporan.judul_laporan as judul_laporan, tempat_sidang.nama_tempat as tempat_nama, dosen.nama as dospeng, dosen.nidn as nidn, pkl_jadwal_sidang.*')
        ->join('mahasiswa', 'mahasiswa.id = pkl_nilai_sidang.mahasiswa_id')
        ->join('dosen', 'dosen.id = pkl_nilai_sidang.dosen_id')
        ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
        ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
        ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->join('pkl_judul_laporan', 'pkl_judul_laporan.mahasiswa_id = mahasiswa.id')
        ->join('pkl_jadwal_sidang', 'pkl_jadwal_sidang.id_pkl_jadwal_sidang  = pkl_nilai_sidang.sidang_id')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat  = pkl_jadwal_sidang.tempat_id')
            ->where('sidang_id', $id)
            ->get()->getRow();
        // dd($data);
        if (!$data) {
            // If data not found, you can show an error message or redirect back
            return redirect()->back()->with('error', 'Data not found.');
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
}
