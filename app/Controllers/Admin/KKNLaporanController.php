<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstansiModel;
use App\Models\MahasiswaModel;
use App\Models\KKNAnggotaModel;
use App\Models\KKNJadwalModel;
use App\Models\KKNJurnalMonitoringModel;
use App\Models\KKNJurnalPelaksanaanModel;
use App\Models\KKNModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class KKNLaporanController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->db = \Config\Database::connect();
        $this->KKN = new KKNModel();
        $this->Anggota = new KKNAnggotaModel();
        $this->Pelaksanaan = new KKNJurnalPelaksanaanModel();
        $this->Monitoring = new KKNJurnalMonitoringModel();
        $this->Prodi = new ProdiModel();
        $this->Instansi = new InstansiModel();
        $this->Mahasiswa = new MahasiswaModel();
    }
    public function index()
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->Mahasiswa->select('mahasiswa.*, kkn.*, prodi.nama_prodi,  dosen.nama as nama_dosen, kkn_lokasi.nama_lokasi as nama_lokasi, mahasiswa.id as mhs_id')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('dosen', 'dosen.id = kkn.dosen_id', 'left')
            ->join('kkn_lokasi', 'kkn_lokasi.id = kkn.lokasi_id', 'left')
            ->groupBy('kkn.id');

        if (!empty($tahun_akademik)) {
            $query->where('tahun_akademik', $tahun_akademik);
        }

        if (!empty($prodi_id)) {
            $query->where('mahasiswa.prodi_id', $prodi_id);
        }

        $list_kkn = $query->findAll(); // Fetch the filtered KKN data
        $prodi = $this->Prodi->findAll();

        $data = [
            'title' => 'Laporan KKN',
            'data_kkn' => $list_kkn,
            'prodi' => $prodi,
            'tahun_akademik' => $tahun_akademik,
            'prodi_id' => $prodi_id,
        ];

        return view('admin/kkn/laporan/index', $data);
    }

    public function cetak()
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');


        $query = $this->Mahasiswa->select('mahasiswa.*, kkn.*, prodi.nama_prodi,  dosen.nama as nama_dosen, kkn_lokasi.nama_lokasi as nama_lokasi')
            ->join('kkn_anggota', 'kkn_anggota.mahasiswa_id = mahasiswa.id', 'left')
            ->join('kkn', 'kkn.id = kkn_anggota.kkn_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('dosen', 'dosen.id = kkn.dosen_id', 'left')
            ->join('kkn_lokasi', 'kkn_lokasi.id = kkn.lokasi_id', 'left')
            ->groupBy('kkn.id');

        if (!empty($tahun_akademik)) {
            $query->where('tahun_akademik', $tahun_akademik);
        }

        if (!empty($prodi_id)) {
            $query->where('mahasiswa.prodi_id', $prodi_id);
        }
        $list_kkn = $query->findAll(); // Fetch the filtered KKN data
        $prodi = $this->Prodi->findAll(); // Fetch the Prodi data

        // Pass the filtered data to the view for generating the PDF
        $data = [
            'data_kkn' => $list_kkn,
            'tahun_akademik' => $tahun_akademik,
            'prodi_id' => $prodi_id,
            'prodi' => $prodi,
        ];

        // Load the view file as a string
        $html = view('admin/kkn/laporan/cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->render();

        // Generate the filename based on the parameters
        $filename = 'laporan_kkn';
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

        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');
        $status = $this->request->getVar('status');
        $jurnal = $this->Pelaksanaan->getJurnalPelaksanaanByIdMahasiswa($mahasiswa_id);
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $mahasiswa_id);
        if (!empty($tahun_akademik)) {
            $mhs->where('tahun_akademik', $tahun_akademik);
        }
        if (!empty($prodi_id)) {
            $mhs->where('prodi.id', $prodi_id);
        }

        if (!empty($status)) {
            $mhs->where('status', $status);
        }
        $getMahasiswa = $mhs->get()->getRow();
        $prodi = null; // Initialize the $prodi variable to null
        if ($getMahasiswa) {
            $prodi = $this->Prodi->find($getMahasiswa->prodi_id);
        }
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'mahasiswa' => $getMahasiswa,
            'jurnals' => $jurnal,

            'tahun_akademik' => $tahun_akademik,
            'getProdi' => $prodi,
        ];
        return view('admin/kkn/laporan/pelaksanaan', $data);
    }

    public function pelaksanaan_cetak($mahasiswa_id)
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');
        $status = $this->request->getVar('status');
        $query = $this->Pelaksanaan->select('kkn_jurnal_pelaksanaan.*, mahasiswa.nim as nim, kkn_lokasi.nama_lokasi as nama_lokasi, mahasiswa.nama as nama_mahasiswa, prodi.nama_prodi,  kkn.tahun_akademik as tahun_akademik, kkn.*')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_pelaksanaan.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id', 'left')
            ->join('kkn_lokasi', 'kkn_lokasi.id = kkn.lokasi_id', 'left')
            ->orderBy('kkn_jurnal_pelaksanaan.hari', 'asc')
            ->orderBy('kkn_jurnal_pelaksanaan.jam', 'asc');

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
            ->select('mahasiswa.*, kkn.tahun_akademik, pembimbing.nama as nama_pembimbing')
            ->join('kkn_jurnal_pelaksanaan', 'kkn_jurnal_pelaksanaan.mahasiswa_id = mahasiswa.id', 'left')
            ->join('kkn', 'kkn.id = kkn_jurnal_pelaksanaan.kkn_id', 'left')
            ->join('dosen as pembimbing', 'pembimbing.id = kkn.dosen_id', 'left')
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
        $html = view('admin/kkn/laporan/pelaksanaan_cetak', $data);

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
        $dompdf->stream('laporan_pelaksanaan_kkn.pdf', ['Attachment' => false]);
    }

    public function monitoring($mahasiswa_id)
    {
        $jurnal = $this->Monitoring->getJurnalMonitoringByIdMahasiswa($mahasiswa_id);
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $mahasiswa_id)->get()->getRow();
        $data = [
            'title' => 'Jurnal Monitoring',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal
        ];
        // dd($jurnal);
        return view('admin/kkn/laporan/monitoring', $data);
    }

    public function monitoring_cetak($mahasiswa_id)
    {
        $tahun_akademik = $this->request->getVar('tahun_akademik');
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->Monitoring->select('kkn_jurnal_monitoring.*, mahasiswa.nim as nim, mahasiswa.nama as nama_mahasiswa, prodi.nama_prodi,  kkn.tahun_akademik as tahun_akademik, kkn.*, dosen.nama as nama_dosen')
            ->join('mahasiswa', 'mahasiswa.id = kkn_jurnal_monitoring.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id', 'left')
            ->join('dosen', 'dosen.id = kkn.dosen_id', 'left')->where('mahasiswa.id', $mahasiswa_id);;

        if (!empty($tahun_akademik)) {
            $query->where('kkn.tahun_akademik', $tahun_akademik);
        }

        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }
 

        $monitoring = $query->findAll(); // Fetch the filtered monitoring data
        $mahasiswa = $this->Mahasiswa
        ->select('mahasiswa.nim, mahasiswa.nama, mahasiswa.prodi_id, kkn.tahun_akademik, pembimbing.id as dosen_id, pembimbing.nama as nama_pembimbing')
        ->join('kkn_jurnal_monitoring', 'kkn_jurnal_monitoring.mahasiswa_id = mahasiswa.id', 'left')
        ->join('kkn', 'kkn.id = kkn_jurnal_monitoring.kkn_id', 'left')
        ->join('dosen as pembimbing', 'pembimbing.id = kkn.dosen_id', 'left')
        ->where('mahasiswa.id', $mahasiswa_id)
        ->get()->getRow();
        // dd($mahasiswa);
        $prodi = $this->Prodi->where('id', $mahasiswa->prodi_id)->get()->getRow();

        // Pass the filtered data to the view for generating the PDF
        $data = [
            'monitoring' => $monitoring,
            'tahun_akademik' => $tahun_akademik,
            'prodi' => $prodi,
            'prodi_id' => $prodi_id,
            'mahasiswa' => $mahasiswa,
            'mahasiswa_id' => $mahasiswa_id,
        ];

        // Load the view file as a string
        $html = view('admin/kkn/laporan/monitoring_cetak', $data);

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
        $dompdf->stream('laporan_bimbingan_kkn.pdf', ['Attachment' => false]);
    }

    public function dospem()
    {
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->db->table('kkn')->select('kkn.*, prodi.nama_prodi, dosen.nama as nama_dospem, mahasiswa.nama as nama_mahasiswa')
            ->join('dosen', 'dosen.id = kkn.dosen_id', 'left')
            ->join('kkn_anggota', 'kkn_anggota.kkn_id = kkn.id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = kkn_anggota.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->where('kkn_anggota.id IS NOT NULL');;

        if (!empty($prodi_id)) {
            $query->where('prodi.id', $prodi_id);
        }

        $dospem = $query->get()->getResultArray(); // Fetch the filtered dospem data
        $getProdi = $this->Prodi->findAll();

        $data = [
            'title' => 'Laporan Dosen Pembimbing KKN',
            'dospem' => $dospem,
            'getProdi' => $getProdi,
            'prodi_id' => $prodi_id,
        ];

        return view('admin/kkn/laporan/dospem', $data);
    }

    public function dospem_cetak()
    {
        $prodi_id = $this->request->getVar('prodi_id');

        $query = $this->db->table('kkn')->select('kkn.*, prodi.nama_prodi, dosen.nama as nama_dospem, mahasiswa.nama as nama_mahasiswa')
            ->join('dosen', 'dosen.id = kkn.dosen_id', 'left')
            ->join('kkn_anggota', 'kkn_anggota.kkn_id = kkn.id', 'left')
            ->join('mahasiswa', 'mahasiswa.id = kkn_anggota.mahasiswa_id', 'left')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left')
            ->where('kkn_anggota.id IS NOT NULL');;

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
        $html = view('admin/kkn/laporan/dospem_cetak', $data);

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
        $dompdf->stream('laporan_dospem_kkn.pdf', ['Attachment' => false]);
    }
}
