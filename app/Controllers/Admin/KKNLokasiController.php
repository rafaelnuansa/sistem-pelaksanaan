<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KKNLokasiModel;

class KKNLokasiController extends BaseController
{
   
    public function index()
    {
        $KKNLokasiModel = new KKNLokasiModel();
        $data['lokasi'] = $KKNLokasiModel->findAll();

        return view('admin/lokasi/index', $data);
    }

    public function create()
    {
        return view('admin/lokasi/create');
    }

    public function store()
    {
        $KKNLokasiModel = new KKNLokasiModel();

        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $KKNLokasiModel->insert($data);

        return redirect()->to('/admin/lokasi')->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $KKNLokasiModel = new KKNLokasiModel();
        $data['lokasi'] = $KKNLokasiModel->find($id);

        return view('admin/lokasi/edit', $data);
    }

    public function update($id)
    {
        $KKNLokasiModel = new KKNLokasiModel();

        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $KKNLokasiModel->update($id, $data);

        return redirect()->to('/admin/lokasi')->with('success', 'Lokasi berhasil diupdate');
    }

    public function delete($id)
    {
        $KKNLokasiModel = new KKNLokasiModel();

        $KKNLokasiModel->delete($id);

        return redirect()->to('/admin/lokasi')->with('success', 'Lokasi berhasil dihapus');
    }
}
