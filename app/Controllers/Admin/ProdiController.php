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
    
        $mahasiswaModel = new MahasiswaModel();
    
        // Hitung jumlah mahasiswa untuk setiap program studi
        foreach ($prodi as &$row) {
            $jumlahMahasiswa = $mahasiswaModel->where('prodi_id', $row['id'])->countAllResults();
            $row['jumlah_mahasiswa'] = $jumlahMahasiswa;
        }
    
        // Menggabungkan data fakultas dengan data program studi
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

        $data = [
            'title' => 'Tambah Program Studi',
            'fakultas' => $fakultas
        ];

        return view('admin/prodi/create', $data);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'fakultas_id' => 'required'
        ]);

        $data = [
            'nama' => $this->request->getPost('nama'),
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
        $this->validate([
            'nama' => 'required',
            'fakultas_id' => 'required'
        ]);

        $data = [
            'nama' => $this->request->getPost('nama'),
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
