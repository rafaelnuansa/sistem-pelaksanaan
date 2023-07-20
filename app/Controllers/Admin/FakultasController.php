<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\MahasiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class FakultasController extends BaseController
{
    public function index()
    {
        $fakultasModel = new FakultasModel();
        $fakultas = $fakultasModel->paginate(8); // Ubah angka 10 sesuai dengan jumlah data yang ingin ditampilkan per halaman

        $prodiModel = new ProdiModel();
        $mahasiswaModel = new MahasiswaModel();

        $data = [
            'title' => 'Fakultas',
            'fakultas' => $fakultas,
            'pager' => $fakultasModel->pager,
            'prodiModel' => $prodiModel,
            'mahasiswaModel' => $mahasiswaModel
        ];

        return view('admin/fakultas/index', $data);
    }


    public function create()
    {   $data['errors'] = session('errors');
        return view('admin/fakultas/create', $data);
    }

    public function store()
    {
        $fakultasModel = new FakultasModel();
 
        // Validation rules for the 'nama' field
        $validationRules = [
            'nama' => [
                'rules' => 'required|is_unique[fakultas.nama]',
                'errors' => [
                    'required' => 'Nama fakultas harus diisi.',
                    'is_unique' => 'Nama fakultas sudah ada.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        $fakultasModel->insert($data);

        return redirect()->to('/admin/fakultas')->with('success', 'Fakultas berhasil dibuat');
    }

    public function edit($id)
    {
        $fakultasModel = new FakultasModel();
        $fakultas = $fakultasModel->find($id);

        if (!$fakultas) {
            return redirect()->to('/admin/fakultas')->with('error', 'Fakultas tidak ada');
        }

        $data = [
            'title' => 'Edit Fakultas',
            'fakultas' => $fakultas
        ];

        return view('admin/fakultas/edit', $data);
    }

    public function update($id)
    {
        $fakultasModel = new FakultasModel();
        $fakultas = $fakultasModel->find($id);

        if (!$fakultas) {
            return redirect()->to('/admin/fakultas')->with('error', 'Fakultas tidak ada');
        }

        // Validation rules for the 'nama' field
        $validationRules = [
            'nama' => [
                'rules' => 'required|is_unique[fakultas.nama,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama fakultas harus diisi.',
                    'is_unique' => 'Nama fakultas sudah ada dalam database.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama')
        ];

        $fakultasModel->update($id, $data);

        return redirect()->to('/admin/fakultas')->with('success', 'Fakultas berhasil diedit');
    }

    public function delete($id)
    {
        $fakultasModel = new FakultasModel();
        $fakultas = $fakultasModel->find($id);

        if (!$fakultas) {
            return redirect()->to('/admin/fakultas')->with('error', 'Fakultas tidak ada');
        }

        $fakultasModel->delete($id);

        return redirect()->to('/admin/fakultas')->with('success', 'Fakultas berhasil dihapus');
    }
}
