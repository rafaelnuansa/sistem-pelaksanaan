<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\BerkasModel;

class BerkasController extends BaseController
{
    protected $berkasModel;

    public function __construct()
    {
        $this->berkasModel = new BerkasModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
    }

    // Menampilkan daftar berkas
    public function index()
    {
        $jenis = $this->request->getGet('jenis');
        $keterangan = $this->request->getGet('keterangan');
        // Tambahkan orderBy di sini

        // Tambahkan orderBy dan where berdasarkan mahasiswa_id
        $data['berkas'] = $this->berkasModel->where('mahasiswa_id', $this->mahasiswaId)->orderBy('id_berkas', 'DESC')->findAll();


        if ($jenis && $keterangan) {
            $data['berkas'] = $this->berkasModel->where(['jenis' => $jenis, 'keterangan' => $keterangan])->findAll();
        } elseif ($jenis) {
            $data['berkas'] = $this->berkasModel->where('jenis', $jenis)->findAll();
        } elseif ($keterangan) {
            $data['berkas'] = $this->berkasModel->where('keterangan', $keterangan)->findAll();
        }

        return view('mahasiswa/berkas/index', $data);
    }

    // Simpan data berkas
    public function store()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate hashname for the file
            $hashName = hash('sha256', $file->getName() . microtime()) . '.' . $file->getExtension();

            // Move the uploaded file to the desired location with the hashname
            $file->move(ROOTPATH . 'public/uploads', $hashName);

            $data = [
                'file' => $hashName, // Save the hashname to the database
                'nama_file' => $this->request->getPost('nama_file'),
                'jenis' => $this->request->getPost('jenis'),
                'keterangan' => $this->request->getPost('keterangan'),
                'mahasiswa_id' => $this->mahasiswaId,
                'tanggal' => date('Y-m-d')
            ];
            -$this->berkasModel->insert($data);
            return redirect()->to('/mahasiswa/berkas')->with('success', 'Berkas berhasil ditambahkan.');
        }
        return redirect()->to('/mahasiswa/berkas')->with('error', 'Gagal mengunggah berkas.');
    }

    public function update()
    {
        $id = $this->request->getPost('berkas_id');
        $file = $this->request->getFile('new_file');
        $existingData = $this->berkasModel->find($id);

        if (!$existingData) {
            return redirect()->to('/mahasiswa/berkas')->with('error', 'Data berkas tidak ditemukan.');
        }

        $data = [
            'nama_file' => $this->request->getPost('nama_file'),
            'jenis' => $this->request->getPost('jenis'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => date('Y-m-d')
        ];

        // Check if a new file is uploaded
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate hashname for the new file
            $hashName = hash('sha256', $file->getName() . microtime()) . '.' . $file->getExtension();

            // Move the uploaded file to the desired location with the hashname
            $file->move(ROOTPATH . 'public/uploads', $hashName);

            // Delete the old file if it exists
            if ($existingData['file'] && file_exists(ROOTPATH . 'public/uploads/' . $existingData['file'])) {
                unlink(ROOTPATH . 'public/uploads/' . $existingData['file']);
            }

            // Save the new file hashname to the database
            $data['file'] = $hashName;
        } else {
            // If no new file is uploaded, keep the existing file data as it is
            $data['file'] = $existingData['file'];
        }

        // Update the data in the database
        try {
            $this->berkasModel->update($id, $data);
            return redirect()->to('/mahasiswa/berkas')->with('success', 'Berkas berhasil diperbarui.');
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during the update process
            return redirect()->to('/mahasiswa/berkas')->with('error', 'Gagal memperbarui berkas: ' . $e->getMessage());
        }
    }




    // Hapus data berkas
    public function delete($id)
    {
        $this->berkasModel->delete($id);
        return redirect()->to('/mahasiswa/berkas')->with('success', 'Berkas berhasil dihapus.');
    }
}
