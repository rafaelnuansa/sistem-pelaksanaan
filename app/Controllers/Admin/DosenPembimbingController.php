<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenPembimbingModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;

class DosenPembimbingController extends BaseController
{
    protected $dosenPembimbingModel;
    protected $dosenModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->dosenPembimbingModel = new DosenPembimbingModel();
        $this->dosenModel = new DosenModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $dosenPembimbing = $this->dosenPembimbingModel->getDospemWithDosenMahasiswaNama();

        $data = [
            'dosenPembimbing' => $dosenPembimbing
        ];

        return view('admin/dosen_pembimbing/index', $data);
    }

    public function create()
    {
        $dosens = $this->dosenModel->findAll();
        $mahasiswas = $this->mahasiswaModel->findAll();

        $data = [
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas
        ];

        return view('admin/dosen_pembimbing/create', $data);
    }

    public function store()
    {
        $data = [
            'dosen_id' => $this->request->getPost('dosen_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jenis_pembimbing' => $this->request->getPost('jenis_pembimbing'),
        ];

        $this->dosenPembimbingModel->insert($data);

        return redirect()->route('admin.dosen_pembimbing.index')->with('success', 'Data dosen pembimbing berhasil ditambahkan');
    }

    public function edit($id_dospem)
    {
        $dosenPembimbing = $this->dosenPembimbingModel->find($id_dospem);
        $dosens = $this->dosenModel->findAll();
        $mahasiswas = $this->mahasiswaModel->findAll();

        $data = [
            'dosenPembimbing' => $dosenPembimbing,
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas
        ];

        return view('admin/dosen_pembimbing/edit', $data);
    }

    public function update($id_dospem)
    {
        $data = [
            'dosen_id' => $this->request->getPost('dosen_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jenis_pembimbing' => $this->request->getPost('jenis_pembimbing'),
        ];

        $this->dosenPembimbingModel->update($id_dospem, $data);

        return redirect()->route('admin.dosen_pembimbing.index')->with('success', 'Data dosen pembimbing berhasil diupdate');
    }

    public function delete($id_dospem)
    {
        $this->dosenPembimbingModel->delete($id_dospem);

        return redirect()->route('admin.dosen_pembimbing.index')->with('success', 'Data dosen pembimbing berhasil dihapus');
    }
}
