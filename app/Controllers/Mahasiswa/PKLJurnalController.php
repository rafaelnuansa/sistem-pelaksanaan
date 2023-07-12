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
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        $this->kelompokId = $getKelompok->id;
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        //
    }

    
    public function pelaksanaan()
    {
         
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'data' => $this->PKLJurnalPelaksanaanModel->where('mahasiswa_id', $this->mahasiswaId)->findAll()
        ];

        return view('mahasiswa/pkl/jurnal/pelaksanaan', $data);
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
            'judul_laporan' => ($judul_laporan != null) ? $judul_laporan['judul_laporan'] : null
        ];

        // dd($data['data']);
        return view('mahasiswa/pkl/jurnal/bimbingan', $data);
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
