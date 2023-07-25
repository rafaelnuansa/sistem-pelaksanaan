<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\SkripsiModel;
use App\Models\ProdiModel;
use App\Models\PembimbingModel;

class SkripsiController extends BaseController
{
    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->pembimbing = new PembimbingModel();
        $this->prodi = new ProdiModel();
        $this->skripsi = new SkripsiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $skripsiModel = new SkripsiModel();

        $skripsis = $skripsiModel
            ->select('skripsi.*, dosen.nama AS nama_dosen, prodi.nama_prodi, mahasiswa.*, mahasiswa.nama as nama_mahasiswa, skripsi.id as id')
            ->join('dosen', 'dosen.id = skripsi.dosen_id')
            ->join('mahasiswa', 'mahasiswa.id = skripsi.mahasiswa_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->findAll();

        $mahasiswa = $this->mahasiswa->findAll();

        $data = [
            'title' => 'SKRIPSI',
            'skripsis' => $skripsis,
            'mahasiswa' => $mahasiswa,
        ];

        return view('admin/skripsi/index', $data);
    }


    public function create()
    {
        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();

        $prodiModel = new ProdiModel();
        $prodis = $prodiModel->findAll();


        $mahasiswaModel = new MahasiswaModel();
        $mahasiswas = $mahasiswaModel->findAll();


        $data = [
            'title' => 'Tambah Skripsi',
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas,
            'prodis' => $prodis,
        ];

        return view('admin/skripsi/create', $data);
    }

    public function store()
    {
        $skripsiModel = new SkripsiModel();
    
        $mahasiswa_id = $this->request->getPost('mahasiswa_id');
    
        try {
            // Cek apakah sudah ada data skripsi mahasiswa dengan ID yang diinputkan
            $existingSkripsi = $skripsiModel->where('mahasiswa_id', $mahasiswa_id)->first();
    
            if ($existingSkripsi) {
                // Ambil nama mahasiswa dari database berdasarkan mahasiswa_id
                $mahasiswaModel = new MahasiswaModel();
                $mahasiswa = $mahasiswaModel->find($mahasiswa_id);
    
                // Jika sudah ada data skripsi mahasiswa, tampilkan pesan dan batalkan proses penyimpanan
                return redirect()->back()->withInput()->with('error', ' (' . $mahasiswa['nama'] . ') telah terdaftar dalam Skripsi.');
            }
    
            // Jika belum ada data skripsi mahasiswa, lakukan penyimpanan data skripsi
            $data = [
                'mahasiswa_id' => $mahasiswa_id,
                'tgl_mulai' => $this->request->getPost('tgl_mulai'),
                'tgl_selesai' => $this->request->getPost('tgl_selesai'),
                'tahun_akademik' => $this->request->getPost('tahun_akademik'),
                'dosen_id' => $this->request->getPost('dosen_id'),
            ];
            $skripsiModel->insert($data);
            return redirect()->to('/admin/skripsi')->with('success', 'Data Skripsi berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangani pengecualian jika terjadi kesalahan dalam proses penyimpanan
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
    


    public function edit($id)
    {
        $skripsiModel = new SkripsiModel();
        $skripsi = $skripsiModel->find($id);

        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();


        $mahasiswaModel = new MahasiswaModel();
        $mahasiswas = $mahasiswaModel->findAll();

        $data = [
            'title' => 'Edit Skripsi',
            'skripsi' => $skripsi,
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas,
        ];

        return view('admin/skripsi/edit', $data);
    }


    public function update($id)
    {
        try {
            $skripsiModel = new SkripsiModel();
    
            // Dapatkan data skripsi yang akan diupdate dari database
            $skripsi = $skripsiModel->find($id);
    
            if (!$skripsi) {
                return redirect()->to('/admin/skripsi')->with('error', 'Data Skripsi tidak ditemukan.');
            }
    
            // Dapatkan mahasiswa_id dari form input
            $mahasiswa_id = $this->request->getPost('mahasiswa_id');
    
            // Jika mahasiswa_id berubah, cek apakah mahasiswa dengan ID baru sudah terdaftar dalam skripsi
            if ($mahasiswa_id != $skripsi['mahasiswa_id']) {
                $existingSkripsi = $skripsiModel->where('mahasiswa_id', $mahasiswa_id)->first();
    
                if ($existingSkripsi) {
                    // Ambil nama mahasiswa dari database berdasarkan mahasiswa_id baru
                    $mahasiswaModel = new MahasiswaModel();
                    $mahasiswa = $mahasiswaModel->find($mahasiswa_id);
    
                    // Tampilkan pesan jika mahasiswa dengan ID baru sudah terdaftar dalam skripsi
                    return redirect()->back()->withInput()->with('error', '(' . $mahasiswa['nama'] . ') telah terdaftar dalam Skripsi.');
                }
            }
    
            // Jika tidak ada masalah, lakukan proses update data skripsi
            $data = [
                'mahasiswa_id' => $mahasiswa_id,
                'tgl_mulai' => $this->request->getPost('tgl_mulai'),
                'tgl_selesai' => $this->request->getPost('tgl_selesai'),
                'tahun_akademik' => $this->request->getPost('tahun_akademik'),
                'dosen_id' => $this->request->getPost('dosen_id'),
            ];
    
            $skripsiModel->update($id, $data);
    
            return redirect()->to('/admin/skripsi')->with('success', 'Data Skripsi berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani exception jika terjadi kesalahan dalam proses update
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function delete($id)
    {
        $skripsiModel = new SkripsiModel();

        $skripsiModel->delete($id);

        return redirect()->to('/admin/skripsi')->with('success', 'Data Skripsi berhasil dihapus.');
    }
}
