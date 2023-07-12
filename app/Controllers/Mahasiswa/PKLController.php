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
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        
        $getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        $kelompokId = $getKelompok->id;

        $akun = $this->AnggotaModel
            ->where('mahasiswa_id', $this->mahasiswaId)
            ->where('pkl_id', $kelompokId)
            ->first();
        
        $rows = $this->AnggotaModel
            ->where('pkl_id', $kelompokId)
            ->join('pkl', 'pkl_anggota.pkl_id = pkl.id')
            ->join('mahasiswa', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
            ->get()
            ->getResultArray();

        $instansi = $this->InstansiModel->find($kelompokId);
        // return d($instansi);

        $data = [
            'title' => 'Kelompok PKL',
            'data' => $rows,
            'instansi' => $instansi,
            'akun' => $akun,
        ];

        return view('mahasiswa/pkl/index', $data);
    }

    public function pelaksanaan()
    {
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'data' => $this->PKLJurnalPelaksanaanModel->where('mahasiswa_id', $this->mahasiswa_id)->findAll()
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
            'jam' => $this->request->getVar('jam'),
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
}
