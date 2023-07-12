<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\PKLJurnalPelaksanaanModel;

class PKLJurnalPelaksanaanController extends BaseController
{
    protected $jurnalModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->jurnalModel = new PKLJurnalPelaksanaanModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasPKL();
        // dd($mahasiswa);
        $data = [
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/pkl/jurnal/pelaksanaan/index', $data);
    }

    public function show($id)
    {
        $jurnal = $this->jurnalModel->getJurnalPelaksanaanByIdMahasiswa($id);
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'jurnals' => $jurnal
        ];
    
        return view('admin/pkl/jurnal/pelaksanaan/show', $data);
    }
    

    public function create()
    {
        return view('admin/pkl/jurnal/pelaksanaan/create');
    }

    public function store()
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jam' => $this->request->getPost('jam'),
            'hari' => $this->request->getPost('hari'),
            'keterangan' => $this->request->getPost('keterangan'),
            'pkl_id' => $this->request->getPost('pkl_id'),
            'status' => $this->request->getPost('status'),
        ];

        $this->jurnalModel->insert($data);

        return redirect()->route('admin.jurnal.pelaksanaan.index')->with('success', 'Data jurnal pelaksanaan berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data = [
            'jurnal' => $this->jurnalModel->find($id),
        ];

        return view('admin/pkl/jurnal/pelaksanaan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jam' => $this->request->getPost('jam'),
            'hari' => $this->request->getPost('hari'),
            'keterangan' => $this->request->getPost('keterangan'),
            'pkl_id' => $this->request->getPost('pkl_id'),
            'status' => $this->request->getPost('status'),
        ];

        $this->jurnalModel->update($id, $data);

        return redirect()->route('admin.jurnal.pelaksanaan.index')->with('success', 'Data jurnal pelaksanaan berhasil diupdate');

    }

    public function delete($id)
    {
        $this->jurnalModel->delete($id);
 
        return redirect()->route('admin.jurnal.pelaksanaan.index')->with('success', 'Data jurnal pelaksanaan berhasil dihapus');

    }
}
