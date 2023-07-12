<?php

namespace App\Controllers\Admin;

use App\Models\TempatModel;
use CodeIgniter\Controller;

class TempatController extends Controller
{
    public function index()
    {
        $model = new TempatModel();
        $data['tempat'] = $model->orderBy('id_tempat', 'desc')->getAll();
        $data['title'] = 'Daftar Tempat';

        // Tampilkan view dengan data tempat
        return view('admin/tempat/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Tempat';

        // Tampilkan form tambah tempat
        return view('admin/tempat/create', $data);
    }

    public function store()
    {
        $model = new TempatModel();

        // Ambil data dari form tambah tempat
        $data = [
            'nama_tempat' => $this->request->getPost('nama_tempat')
        ];

        // Simpan data tempat baru
        $model->create($data);

        // Set flash data
        session()->setFlashdata('success', 'Tempat berhasil ditambahkan.');

        // Redirect ke halaman index
        return redirect()->route('admin.tempat.index');
    }

    public function edit($id)
    {
        $model = new TempatModel();
        $data['tempat'] = $model->getById($id);
        $data['title'] = 'Edit Tempat';

        // Tampilkan form edit tempat
        return view('admin/tempat/edit', $data);
    }

    public function update($id)
    {
        $model = new TempatModel();

        // Ambil data dari form edit tempat
        $data = [
            'nama_tempat' => $this->request->getPost('nama_tempat')
        ];

        // Perbarui data tempat berdasarkan ID
        $model->updateData($id, $data);

        // Set flash data
        session()->setFlashdata('success', 'Tempat berhasil diperbarui.');
 
        // Redirect ke halaman index
        return redirect()->route('admin.tempat.index');
    }

    public function delete($id)
    {
        $model = new TempatModel();

        // Hapus data tempat berdasarkan ID
        $model->deleteData($id);

        // Set flash data
        session()->setFlashdata('success', 'Tempat berhasil dihapus.');

        // Redirect ke halaman index
        return redirect()->route('admin.tempat.index');
    }
}
