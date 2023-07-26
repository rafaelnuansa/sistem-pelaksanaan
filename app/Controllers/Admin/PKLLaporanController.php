<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstansiModel;
use App\Models\MahasiswaModel;
use App\Models\PKLAnggotaModel;
use App\Models\PKLJadwalModel;
use App\Models\PKLJurnalBimbinganModel;
use App\Models\PKLJurnalPelaksanaanModel;
use App\Models\PKLModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class PKLLaporanController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->db = \Config\Database::connect();
        $this->PKL = new PKLModel();
        $this->Anggota = new PKLAnggotaModel();
        $this->Pelaksanaan = new PKLJurnalPelaksanaanModel();
        $this->Bimbingan = new PKLJurnalBimbinganModel();
        $this->Jadwal = new PKLJadwalModel();
        $this->Prodi = new ProdiModel();
        $this->Instansi = new InstansiModel();
        $this->Mahasiswa = new MahasiswaModel();
    }
    public function index()
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->Mahasiswa->select('mahasiswa.*, pkl.*, prodi.nama_prodi,  dosen.nama as nama_dosen, pkl.prodi_id, instansi.nama_perusahaan as nama_perusahaan, pkl_nilai_sidang.*, mahasiswa.id as mhs_id')
            ->join('pkl_nilai_sidang', 'pkl_nilai_sidang.mahasiswa_id = mahasiswa.id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('dosen', 'dosen.id = pkl.dosen_id', 'left')
            ->join('instansi', 'instansi.id = pkl.instansi_id', 'left')
            ->groupBy('pkl.id');

        if (!empty($tahun_akademik)) {
            $query->where('tahun_akademik', $tahun_akademik);
        }

        if (!empty($prodi_id)) {
            $query->where('mahasiswa.prodi_id', $prodi_id);
        }

        $list_pkl = $query->findAll(); // Fetch the filtered PKL data
        $prodi = $this->Prodi->findAll();

        $data = [
            'title' => 'Laporan PKL',
            'data_pkl' => $list_pkl,
            'prodi' => $prodi,
            'tahun_akademik' => $tahun_akademik,
            'prodi_id' => $prodi_id,
        ];
 
        return view('admin/pkl/laporan/index', $data);
    }

    public function cetak()
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');

    
        $query = $this->Mahasiswa->select('mahasiswa.*, pkl.*, prodi.nama_prodi,  dosen.nama as nama_dosen, pkl.prodi_id, instansi.nama_perusahaan as nama_perusahaan, pkl_nilai_sidang.*')
            ->join('pkl_nilai_sidang', 'pkl_nilai_sidang.mahasiswa_id = mahasiswa.id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('pkl', 'pkl.id = pkl_anggota.pkl_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('dosen', 'dosen.id = pkl.dosen_id', 'left')
            ->join('instansi', 'instansi.id = pkl.instansi_id', 'left')
            ->groupBy('pkl.id');

        if (!empty($tahun_akademik)) {
            $query->where('tahun_akademik', $tahun_akademik);
        }

        if (!empty($prodi_id)) {
            $query->where('mahasiswa.prodi_id', $prodi_id);
        }
        $list_pkl = $query->findAll(); // Fetch the filtered PKL data
        $prodi = $this->Prodi->findAll(); // Fetch the Prodi data

        // Pass the filtered data to the view for generating the PDF
        $data = [
            'data_pkl' => $list_pkl,
            'tahun_akademik' => $tahun_akademik,
            'prodi_id' => $prodi_id,
            'prodi' => $prodi,
        ];

        // Load the view file as a string
        $html = view('admin/pkl/laporan/cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();

        // Generate the filename based on the parameters
        $filename = 'laporan_pkl';
        if (!empty($tahun_akademik)) {
            $filename .= '_' . $tahun_akademik;
        }
        if (!empty($prodi_id)) {
            $filename .= '_prodi_' . $prodi_id;
        }
        $filename .= '.pdf';

        // Output the generated PDF to the browser
        $dompdf->stream($filename, ['Attachment' => false]);
    }

    public function pelaksanaan($mahasiswa_id)
    {
        $jurnal = $this->Pelaksanaan->getJurnalPelaksanaanByIdMahasiswa($mahasiswa_id);
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $mahasiswa_id)->get()->getRow();
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal
        ];
        return view('admin/pkl/laporan/pelaksanaan', $data);
    }
 
    public function pelaksanaan_cetak($mahasiswa_id)
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');
        $status = $this->request->getVar('status');
        $query = $this->Pelaksanaan->select('pkl_jurnal_pelaksanaan.*, mahasiswa.nim as nim, instansi.nama_perusahaan as nama_perusahaan, mahasiswa.nama as nama_mahasiswa, prodi.nama_prodi,  pkl.tahun_akademik as tahun_akademik, pkl.*')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_pelaksanaan.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('pkl', 'pkl.id = pkl_jurnal_pelaksanaan.pkl_id', 'left')
            ->join('instansi', 'instansi.id = pkl.instansi_id', 'left')
            ->orderBy('pkl_jurnal_pelaksanaan.hari', 'asc')
            ->orderBy('pkl_jurnal_pelaksanaan.jam', 'asc');

        if (!empty($tahun_akademik)) {
            $query->where('tahun_akademik', $tahun_akademik);
        }
        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }
    
        if (!empty($mahasiswa_id)) {
            $query->where('mahasiswa.id', $mahasiswa_id);
        }
        $pelaksanaan = $query->findAll(); // Fetch the filtered pelaksanaan data

        $mahasiswa = $this->Mahasiswa
        ->select('mahasiswa.*, pkl.tahun_akademik')
        ->join('pkl_jurnal_bimbingan', 'pkl_jurnal_bimbingan.mahasiswa_id = mahasiswa.id', 'left')
        ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id', 'left')
        ->where('mahasiswa.id', $mahasiswa_id)
        ->get()->getRow();
        $prodi = $this->Prodi->where('id', $mahasiswa->prodi_id)->get()->getRow();
        // Pass the filtered data to the view for generating the PDF
        $data = [
            'pelaksanaan' => $pelaksanaan,
            'tahun_akademik' => $tahun_akademik,
            'prodi' => $prodi,
            'prodi_id' => $prodi_id,
            'status' => $status,
            'mahasiswa' => $mahasiswa,
            'mahasiswa_id' => $mahasiswa_id,
        ];
 
        // Load the view file as a string
        $html = view('admin/pkl/laporan/pelaksanaan_cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Set Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        // Render the PDF
        $dompdf->setOptions($options);
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('laporan_pelaksanaan_pkl.pdf', ['Attachment' => false]);
    }

    public function bimbingan($mahasiswa_id)
    {
        $jurnal = $this->Bimbingan->getJurnalBimbinganByIdMahasiswa($mahasiswa_id);
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $mahasiswa_id)->get()->getRow();
        $data = [
            'title' => 'Jurnal Bimbingan',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal
        ];
        return view('admin/pkl/laporan/bimbingan', $data);
    }

    public function bimbingan_cetak($mahasiswa_id)
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->Bimbingan->select('pkl_jurnal_bimbingan.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, prodi.nama_prodi,  pkl.tahun_akademik as tahun_akademik, pkl.*, dosen.nama as nama_dosen')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jurnal_bimbingan.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id', 'left')
            ->join('dosen', 'dosen.id = pkl.dosen_id', 'left')->where('mahasiswa.id', $mahasiswa_id);;

        if (!empty($tahun_akademik)) {
            $query->where('pkl.tahun_akademik', $tahun_akademik);
        }

        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }


        $bimbingan = $query->findAll(); // Fetch the filtered bimbingan data
        $mahasiswa = $this->Mahasiswa
        ->select('mahasiswa.*, pkl.tahun_akademik')
        ->join('pkl_jurnal_bimbingan', 'pkl_jurnal_bimbingan.mahasiswa_id = mahasiswa.id', 'left')
        ->join('pkl', 'pkl.id = pkl_jurnal_bimbingan.pkl_id', 'left')
        ->where('mahasiswa.id', $mahasiswa_id)
        ->get()->getRow();
        $prodi = $this->Prodi->where('id', $mahasiswa->prodi_id)->get()->getRow();
        
        // Pass the filtered data to the view for generating the PDF
        $data = [
            'bimbingan' => $bimbingan,
            'tahun_akademik' => $tahun_akademik,
            'prodi' => $prodi,
            'prodi_id' => $prodi_id,
            'mahasiswa' => $mahasiswa,
            'mahasiswa_id' => $mahasiswa_id,
        ];

        // Load the view file as a string
        $html = view('admin/pkl/laporan/bimbingan_cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Set Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        // Render the PDF
        $dompdf->setOptions($options);
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('laporan_bimbingan_pkl.pdf', ['Attachment' => false]);
    }

    public function jadwal()
    {
        $prodi_id = $this->request->getVar('prodi_id');
        $tanggal = $this->request->getVar('tanggal');

        $query = $this->Jadwal->select('pkl_jadwal_sidang.*, tempat_sidang.*, mahasiswa.*, dosen.nama as dospeng_nama')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left');

        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }
        if (!empty($tanggal)) {
            $query->where('pkl_jadwal_sidang.tanggal', $tanggal);
        }
        $jadwal = $query->findAll(); // Fetch the filtered jadwal data
        $getProdi = $this->Prodi->findAll();
        $data = [
            'title' => 'Laporan Jadwal PKL',
            'jadwal' => $jadwal,
            'getProdi' => $getProdi,
            'prodi_id' => $prodi_id,
            'tanggal' => $tanggal,
        ];

        return view('admin/pkl/laporan/jadwal', $data);
    }

    public function jadwal_cetak()
    {
        $prodi_id = $this->request->getVar('prodi_id');
        $tanggal = $this->request->getVar('tanggal');

        $query = $this->Jadwal->select('pkl_jadwal_sidang.*, tempat_sidang.*, mahasiswa.*, dosen.nama as dospeng_nama')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left');
        if (!empty($tanggal)) {
            $query->where('pkl_jadwal_sidang.tanggal', $tanggal);
        }
        $jadwal = $query->findAll(); // Fetch the filtered jadwal data
        $getProdi = $this->Prodi->findAll();
        $data = [
            'title' => 'Laporan Jadwal PKL',
            'jadwal' => $jadwal,
            'getProdi' => $getProdi,
            'prodi_id' => $prodi_id,
            'tanggal' => $tanggal,
        ];
        // Load the view file as a string
        $html = view('admin/pkl/laporan/jadwal_cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('laporan_jadwal_pkl.pdf', ['Attachment' => false]);
    }

    public function dospem()
    {
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->db->table('pkl')->select('pkl.*, prodi.nama_prodi, dosen.nama as nama_dospem, mahasiswa.nama as nama_mahasiswa')
            ->join('dosen', 'dosen.id = pkl.dosen_id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.pkl_id = pkl.id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = pkl_anggota.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->where('pkl_anggota.id IS NOT NULL');;

        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }

        $dospem = $query->get()->getResultArray(); // Fetch the filtered dospem data
        $getProdi = $this->Prodi->findAll();

        $data = [
            'title' => 'Laporan Dosen Pembimbing PKL',
            'dospem' => $dospem,
            'getProdi' => $getProdi,
            'prodi_id' => $prodi_id,
        ];

        return view('admin/pkl/laporan/dospem', $data);
    }

    public function dospem_cetak()
    {
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->db->table('pkl')->select('pkl.*, prodi.nama_prodi, dosen.nama as nama_dospem, mahasiswa.nama as nama_mahasiswa')
            ->join('dosen', 'dosen.id = pkl.dosen_id', 'left')
            ->join('pkl_anggota', 'pkl_anggota.pkl_id = pkl.id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = pkl_anggota.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->where('pkl_anggota.id IS NOT NULL');;

        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }

        $dospem = $query->get()->getResultArray(); // Fetch the filtered dospem data
        $getProdi = $this->Prodi->findAll();

        $data = [
            'dospem' => $dospem,
            'getProdi' => $getProdi,
            'prodi_id' => $prodi_id,
        ];

        // Load the view file as a string
        $html = view('admin/pkl/laporan/dospem_cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Set Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        // Render the PDF
        $dompdf->setOptions($options);
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('laporan_dospem_pkl.pdf', ['Attachment' => false]);
    }
}
