<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstansiModel;

class InstansiController extends BaseController
{
    public function index()
    {
        $instansiModel = new InstansiModel();
        $data['instansi'] = $instansiModel->findAll();

        return view('admin/instansi/index', $data);
    }

    public function create()
    {
        return view('admin/instansi/create');
    }

    public function store()
    {
        $instansiModel = new InstansiModel();

        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat' => $this->request->getPost('alamat'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $instansiModel->insert($data);

        return redirect()->to('/admin/instansi')->with('success', 'Instansi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $instansiModel = new InstansiModel();
        $data['instansi'] = $instansiModel->find($id);

        return view('admin/instansi/edit', $data);
    }

    public function update($id)
    {
        $instansiModel = new InstansiModel();

        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat' => $this->request->getPost('alamat'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $instansiModel->update($id, $data);

        return redirect()->to('/admin/instansi')->with('success', 'Instansi berhasil diupdate');
    }

    public function delete($id)
    {
        $instansiModel = new InstansiModel();

        $instansiModel->delete($id);

        return redirect()->to('/admin/instansi')->with('success', 'Instansi berhasil dihapus');
    }
}
