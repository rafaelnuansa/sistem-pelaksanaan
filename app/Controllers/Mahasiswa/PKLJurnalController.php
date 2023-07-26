<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\PKLAnggotaModel;
use App\Models\PKLJudulLaporanModel;
use App\Models\PKLJurnalBimbinganModel;
use App\Models\PKLJurnalPelaksanaanModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class PKLJurnalController extends BaseController
{

    public function __construct()
    {
        $this->pdf = new Dompdf();
        $this->PKLJurnalPelaksanaanModel = new PKLJurnalPelaksanaanModel();
        $this->PKLJurnalBimbinganModel = new PKLJurnalBimbinganModel();
        $this->ProdiModel = new ProdiModel();
        $this->JudulLaporan = new PKLJudulLaporanModel();
        $this->AnggotaModel = new PKLAnggotaModel();
        $this->getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        if ($this->getKelompok) {
            $this->kelompokId = $this->getKelompok->id;
            $this->dospemId = $this->getKelompok->dosen_id;
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
                'data' => $this->PKLJurnalPelaksanaanModel->getJurnalPelaksanaanByIdMahasiswa($this->mahasiswaId),
                'kelompokId' => $this->kelompokId ?? '',
            ];

            return view('mahasiswa/pkl/jurnal/pelaksanaan', $data);
        } else {
            // Tindakan yang diambil jika belum ada kelompok
            $data = [
                'title' => 'Jurnal Pelaksanaan',
                'data' => [],
                'kelompokId' => null,
            ];

            return view('mahasiswa/pkl/jurnal/pelaksanaan', $data);
        }
    }

    public function pelaksanaan_cetak()
    {
        $getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();

        // Memeriksa apakah $getKelompok mengembalikan nilai atau tidak

        $this->kelompokId = $getKelompok->id;
        // Lanjutkan dengan kode Anda yang sudah ada
        $jurnal = $this->PKLJurnalPelaksanaanModel->getJurnalPelaksanaanByIdMahasiswa($this->mahasiswaId);
        // Check if $jurnal is not empty and extract the data if available
        if (!empty($jurnal)) {
            // Get the first row from the $jurnal array
            $firstRow = reset($jurnal);

            // Extract the 'nama_perusahaan' and 'alamat_perusahaan' from the first row
            $nama_perusahaan = $firstRow['nama_perusahaan'];
            $alamat_perusahaan = $firstRow['alamat_perusahaan'];
            
        }
        $nama_pembimbing = $getKelompok->bimbingan_perusahaan;
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'data' => $jurnal,
            'kelompokId' => $this->kelompokId ?? '',
            'mahasiswa' => $this->db->table('mahasiswa')->where('id', $this->mahasiswaId)->get()->getRow(),
            'nama_perusahaan' => $nama_perusahaan ?? '-',
            'alamat_perusahaan' => $alamat_perusahaan ?? '-',
            'nama_pembimbing' => $nama_pembimbing ?? '-',
        ];

        // Load the view file as a string
        $html = view('mahasiswa/pkl/jurnal/pelaksanaan_cetak', $data);

        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('laporan_jadwal_pkl.pdf', ['Attachment' => false]);
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
        $jurnalPelaksanaan = $this->PKLJurnalPelaksanaanModel->find($id);
        if (!$jurnalPelaksanaan) {
            return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan')->with('error', 'Jurnal Pelaksanaan not found.');
        }


        $this->PKLJurnalPelaksanaanModel->update($id, $data);
        return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan')->with('success', 'Jurnal Pelaksanaan berhasil diperbarui.');
    }

    public function delete_pelaksanaan($id)
    {
        $jurnalPelaksanaan = $this->PKLJurnalPelaksanaanModel->find($id);

        if (!$jurnalPelaksanaan) {
            return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan')->with('error', 'Jurnal Pelaksanaan not found.');
        }

        // Lakukan tindakan untuk menghapus jurnal pelaksanaan
        $this->PKLJurnalPelaksanaanModel->delete($id);

        return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan')->with('success', 'Jurnal Pelaksanaan successfully deleted.');
    }

    public function storePelaksanaan()
    {
        $data = [
            'mahasiswa_id' => $this->mahasiswaId,
            'jam' => $this->request->getVar('jam'),
            'hari' => $this->request->getVar('hari'),
            'pkl_id' => $this->kelompokId,
            'keterangan' => $this->request->getVar('keterangan'),
        ];

        // insert data
        // dd($data);
        $this->PKLJurnalPelaksanaanModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    public function validasiPelaksanaan($id)
    {
        $data = $this->PKLJurnalPelaksanaanModel->find($id);
        $data['status'] = 'Approved';

        $this->PKLJurnalPelaksanaanModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');

        return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan');
    }

    public function unvalidasiPelaksanaan($id)
    {
        $data = $this->PKLJurnalPelaksanaanModel->find($id);
        $data['status'] = 'Pending';

        $this->PKLJurnalPelaksanaanModel->save($data);

        session()->setFlashdata('success', 'Jurnal berhasil di ubah!');

        return redirect()->to('/mahasiswa/pkl/jurnal/pelaksanaan');
    }

    public function bimbingan()
    {
        $judul_laporan = $this->JudulLaporan->where('mahasiswa_id', $this->mahasiswaId)->first();

        $data = [
            'title' => 'Jurnal Bimbingan',
            'data' => $this->PKLJurnalBimbinganModel->where('mahasiswa_id', $this->mahasiswaId)->findAll(),
            'judul_laporan' => ($judul_laporan != null) ? $judul_laporan['judul_laporan'] : null,
            'kelompokId' => $this->kelompokId ?? null,
        ];

        // dd($data['data']);
        return view('mahasiswa/pkl/jurnal/bimbingan', $data);
    }
    public function edit_bimbingan($id)
    {
        // Validasi data yang diinputkan jika diperlukan

        $data = [
            'jam' => $this->request->getPost('jam'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $jurnalBimbingan = $this->PKLJurnalBimbinganModel->find($id);
        if (!$jurnalBimbingan) {
            return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan')->with('error', 'Jurnal Bimbingan not found.');
        }


        $this->PKLJurnalBimbinganModel->update($id, $data);
        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan')->with('success', 'Jurnal Bimbingan berhasil diperbarui.');
    }

    public function delete_bimbingan($id)
    {
        $jurnalBimbingan = $this->PKLJurnalBimbinganModel->find($id);

        if (!$jurnalBimbingan) {
            return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan')->with('error', 'Jurnal Bimbingan not found.');
        }
        // Lakukan tindakan untuk menghapus jurnal bimbingan
        $this->PKLJurnalBimbinganModel->delete($id);

        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan')->with('success', 'Jurnal Bimbingan successfully deleted.');
    }

    public function simpanJudulLaporan()
    {
        $judulLaporan = $this->request->getVar('judul_laporan');
        $mahasiswaId = $this->mahasiswaId;

        // Cek apakah data judul laporan sudah ada
        $existingData = $this->JudulLaporan->where('mahasiswa_id', $mahasiswaId)->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan update
            $this->JudulLaporan->update($existingData['id_judul_laporan'], [
                'judul_laporan' => $judulLaporan,
                'mahasiswa_id' => $mahasiswaId,
            ]);
            session()->setFlashdata('success', 'Judul berhasil diperbarui!');
        } else {
            // Jika data belum ada, lakukan insert
            $this->JudulLaporan->insert([
                'judul_laporan' => $judulLaporan,
                'mahasiswa_id' => $mahasiswaId,
            ]);
            session()->setFlashdata('success', 'Judul berhasil disimpan!');
        }

        return redirect()->back();
    }

    public function storeBimbingan()
    {

        $data = [

            'mahasiswa_id' => $this->mahasiswaId,
            'jam' => $this->request->getVar('jam'),
            'tanggal' => $this->request->getVar('tanggal'),
            'pkl_id' => $this->kelompokId,
            'catatan' => $this->request->getVar('keterangan'),
        ];
        // insert data
        $this->PKLJurnalBimbinganModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan!');

        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
    }

    public function validasiBimbingan($id)
    {
        $data = $this->PKLJurnalBimbinganModel->find($id);
        $data['status'] = 'Approved';
        $this->PKLJurnalBimbinganModel->save($data);
        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');
        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
    }

    public function unvalidasiBimbingan($id)
    {
        $data = $this->PKLJurnalBimbinganModel->find($id);
        $data['status'] = 'Pending';
        $this->PKLJurnalBimbinganModel->save($data);
        session()->setFlashdata('success', 'Jurnal berhasil di validasi!');
        return redirect()->to('/mahasiswa/pkl/jurnal/bimbingan');
    }
}
