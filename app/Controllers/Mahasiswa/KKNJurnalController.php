<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\KKNAnggotaModel;
use App\Models\KKNJurnalMonitoringModel;
use App\Models\KKNJurnalPelaksanaanModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class KKNJurnalController extends BaseController
{

    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->KKNJurnalPelaksanaanModel = new KKNJurnalPelaksanaanModel();
        $this->KKNJurnalMonitoringModel = new KKNJurnalMonitoringModel();
        $this->ProdiModel = new ProdiModel();
        $this->AnggotaModel = new KKNAnggotaModel();
        $this->getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        if ($this->getKelompok) {
            $this->kelompokId = $this->getKelompok->id;
        }
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->db = \Config\Database::connect();
    }

    public function pelaksanaan()
    {
        $getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();

        // Memeriksa apakah $getKelompok mengembalikan nilai atau tidak
        if ($getKelompok) {
            $this->kelompokId = $getKelompok->id;
            // Lanjutkan dengan kode Anda yang sudah ada
            $data = [
                'title' => 'Jurnal Pelaksanaan',
                'data' => $this->KKNJurnalPelaksanaanModel->getJurnalPelaksanaanByIdMahasiswa($this->mahasiswaId),
                'kelompokId' => $this->kelompokId ?? '',
            ];

            return view('mahasiswa/kkn/jurnal/pelaksanaan', $data);
        } else {
            // Tindakan yang diambil jika belum ada kelompok
            $data = [
                'title' => 'Jurnal Pelaksanaan',
                'data' => [],
                'kelompokId' => null,
            ];

            return view('mahasiswa/kkn/jurnal/pelaksanaan', $data);
        }
    }

    public function pelaksanaan_cetak()
    {
        $getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();

        // Memeriksa apakah $getKelompok mengembalikan nilai atau tidak

        $this->kelompokId = $getKelompok->id;
        // Lanjutkan dengan kode Anda yang sudah ada
        $jurnal = $this->KKNJurnalPelaksanaanModel->getJurnalPelaksanaanByIdMahasiswa($this->mahasiswaId);
        // Check if $jurnal is not empty and extract the data if available
        if (!empty($jurnal)) {
            // Get the first row from the $jurnal array
            $firstRow = reset($jurnal);

            // Extract the 'nama_perusahaan' and 'alamat_perusahaan' from the first row
            $nama_perusahaan = $firstRow['nama_perusahaan'];
            $alamat_perusahaan = $firstRow['alamat_perusahaan'];
            
        }

        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'data' => $jurnal,
            'kelompokId' => $this->kelompokId ?? '',
            'mahasiswa' => $this->db->table('mahasiswa')->where('id', $this->mahasiswaId)->get()->getRow(),
            'nama_perusahaan' => $nama_perusahaan,
            'alamat_perusahaan' => $alamat_perusahaan,
        ];

        // Load the view file as a string
        $html = view('mahasiswa/kkn/jurnal/pelaksanaan_cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('laporan_jadwal_kkn.pdf', ['Attachment' => false]);
    }

    public function edit_pelaksanaan($id)
    {
        // Validasi data yang diinputkan jika diperlukan

        $data = [
            'jam' => $this->request->getPost('jam'),
            'hari' => $this->request->getPost('hari'),
            'keterangan' => $this->request->getPost('keterangan'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $jurnalPelaksanaan = $this->KKNJurnalPelaksanaanModel->find($id);
        if (!$jurnalPelaksanaan) {
            return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan')->with('error', 'Jurnal Pelaksanaan not found.');
        }


        $this->KKNJurnalPelaksanaanModel->update($id, $data);
        return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan')->with('success', 'Jurnal Pelaksanaan berhasil diperbarui.');
    }

    public function delete_pelaksanaan($id)
    {
        $jurnalPelaksanaan = $this->KKNJurnalPelaksanaanModel->find($id);

        if (!$jurnalPelaksanaan) {
            return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan')->with('error', 'Jurnal Pelaksanaan not found.');
        }

        // Lakukan tindakan untuk menghapus jurnal pelaksanaan
        $this->KKNJurnalPelaksanaanModel->delete($id);

        return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan')->with('success', 'Jurnal Pelaksanaan successfully deleted.');
    }

    public function storePelaksanaan()
    {
        $data = [
            'mahasiswa_id' => $this->mahasiswaId,
            'jam' => $this->request->getVar('jam'),
            'hari' => $this->request->getVar('hari'),
            'kkn_id' => $this->kelompokId,
            'keterangan' => $this->request->getVar('keterangan'),
        ];

        // insert data
        // dd($data);
        $this->KKNJurnalPelaksanaanModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    public function validasiPelaksanaan($id)
    {
        $data = $this->KKNJurnalPelaksanaanModel->find($id);
        $data['status'] = 'Approved';

        $this->KKNJurnalPelaksanaanModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan');
    }

    public function unvalidasiPelaksanaan($id)
    {
        $data = $this->KKNJurnalPelaksanaanModel->find($id);
        $data['status'] = 'Pending';

        $this->KKNJurnalPelaksanaanModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di ubah!');

        return redirect()->to('/mahasiswa/kkn/jurnal/pelaksanaan');
    }

    public function monitoring()
    {
        $data = [
            'title' => 'Jurnal Monitoring',
            'data' => $this->KKNJurnalMonitoringModel->where('mahasiswa_id', $this->mahasiswaId)->findAll(),
            'kelompokId' => $this->kelompokId ?? null,
        ];

        // dd($data['data']);
        return view('mahasiswa/kkn/jurnal/monitoring', $data);
    }
    public function edit_monitoring($id)
    {
        // Validasi data yang diinputkan jika diperlukan

        $data = [
            'jam' => $this->request->getPost('jam'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $jurnalMonitoring = $this->KKNJurnalMonitoringModel->find($id);
        if (!$jurnalMonitoring) {
            return redirect()->to('/mahasiswa/kkn/jurnal/monitoring')->with('error', 'Jurnal Monitoring not found.');
        }


        $this->KKNJurnalMonitoringModel->update($id, $data);
        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring')->with('success', 'Jurnal Monitoring berhasil diperbarui.');
    }

    public function delete_monitoring($id)
    {
        $jurnalMonitoring = $this->KKNJurnalMonitoringModel->find($id);

        if (!$jurnalMonitoring) {
            return redirect()->to('/mahasiswa/kkn/jurnal/monitoring')->with('error', 'Jurnal Monitoring not found.');
        }
        // Lakukan tindakan untuk menghapus jurnal monitoring
        $this->KKNJurnalMonitoringModel->delete($id);

        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring')->with('success', 'Jurnal Monitoring successfully deleted.');
    }

    public function storeMonitoring()
    {

        $data = [

            'mahasiswa_id' => $this->mahasiswaId,
            'jam' => $this->request->getVar('jam'),
            'tanggal' => $this->request->getVar('tanggal'),
            'kkn_id' => $this->kelompokId,
            'catatan' => $this->request->getVar('keterangan'),
        ];
        // insert data
        $this->KKNJurnalMonitoringModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');

        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring');
    }

    public function validasiMonitoring($id)
    {
        $data = $this->KKNJurnalMonitoringModel->find($id);
        $data['status'] = 'Approved';
        $this->KKNJurnalMonitoringModel->save($data);
        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');
        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring');
    }

    public function unvalidasiMonitoring($id)
    {
        $data = $this->KKNJurnalMonitoringModel->find($id);
        $data['status'] = 'Pending';
        $this->KKNJurnalMonitoringModel->save($data);
        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');
        return redirect()->to('/mahasiswa/kkn/jurnal/monitoring');
    }
}
