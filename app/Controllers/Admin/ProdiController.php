<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class ProdiController extends BaseController
{
    protected $prodiModel;
    protected $fakultasModel;

    public function __construct()
    {
        $this->prodiModel = new ProdiModel();
        $this->fakultasModel = new FakultasModel();
    }
    public function index()
    {
        $prodiModel = new ProdiModel();
        $prodi = $prodiModel->findAll();
    
        // Merge the data of fakultas into the program study data
        $prodiWithFakultas = [];
        foreach ($prodi as $row) {
            $fakultas = $this->fakultasModel->find($row['fakultas_id']);
            $row['fakultas'] = $fakultas;
            $prodiWithFakultas[] = $row;
        }
    
        $data = [
            'title' => 'Program Studi',
            'prodi' => $prodiWithFakultas
        ];
    
        return view('admin/prodi/index', $data);
    }
    

    public function create()
    {
        $fakultas = $this->fakultasModel->findAll();

        // Pass the validation errors to the view
        $data = [
            'title' => 'Tambah Program Studi',
            'fakultas' => $fakultas,
            'errors' => session('errors') // This assumes you are using CodeIgniter's session helper to store validation errors.
    ];

        return view('admin/prodi/create', $data);
    }

    public function store()
    {
        // Validation rules
        $validationRules = [
            'nama_prodi' => [
                'rules' => 'required|is_unique[prodi.nama_prodi]',
                'errors' => [
                    'required' => 'Nama program studi harus diisi.',
                    'is_unique' => 'Nama program studi sudah ada dalam database.'
                ]
            ],
            'fakultas_id' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            $fakultas = $this->fakultasModel->findAll();
            $data = [
                'title' => 'Tambah Program Studi',
                'fakultas' => $fakultas,
                'errors' => $this->validator->getErrors()
            ];
            return view('admin/prodi/create', $data);
        }

        $data = [
            'nama_prodi' => $this->request->getPost('nama_prodi'),
            'fakultas_id' => $this->request->getPost('fakultas_id')
        ];

        $this->prodiModel->insert($data);

        return redirect()->to('/admin/prodi')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prodi = $this->prodiModel->find($id);
        $fakultas = $this->fakultasModel->findAll();

        $data = [
            'title' => 'Edit Program Studi',
            'prodi' => $prodi,
            'fakultas' => $fakultas
        ];

        return view('admin/prodi/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'nama_prodi' => [
                'rules' => 'required|is_unique[prodi.nama_prodi,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama program studi harus diisi.',
                    'is_unique' => 'Nama program studi sudah ada dalam database.'
                ]
            ],
            'fakultas_id' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            $prodi = $this->prodiModel->find($id);
            $fakultas = $this->fakultasModel->findAll();
            $data = [
                'title' => 'Edit Program Studi',
                'prodi' => $prodi,
                'fakultas' => $fakultas,
                'errors' => $this->validator->getErrors()
            ];
            return view('admin/prodi/edit', $data);
        }

        $data = [
            'nama_prodi' => $this->request->getPost('nama_prodi'),
            'fakultas_id' => $this->request->getPost('fakultas_id')
        ];

        $this->prodiModel->update($id, $data);

        return redirect()->to('/admin/prodi')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->prodiModel->delete($id);

        return redirect()->to('/admin/prodi')->with('success', 'Program Studi berhasil dihapus.');
    }
}
