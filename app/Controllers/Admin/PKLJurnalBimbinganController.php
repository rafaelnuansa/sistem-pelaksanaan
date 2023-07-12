<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\PKLJurnalBimbinganModel;
class PKLJurnalBimbinganController extends BaseController
{
    protected $jurnalModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->jurnalModel = new PKLJurnalBimbinganModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasPKL();
        $data = [
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/pkl/jurnal/bimbingan/index', $data);
    } 

    public function show($id)
    {
        $jurnal = $this->jurnalModel->getJurnalBimbinganByIdMahasiswa($id);
        $data = [
            'title' => 'Jurnal Bimbingan',
            'jurnals' => $jurnal
        ];
    
        return view('admin/pkl/jurnal/bimbingan/show', $data);
    }
    

    public function create()
    {
        return view('admin/pkl/jurnal/bimbingan/create');
    }

    public function store()
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jam' => $this->request->getPost('jam'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
            'pkl_id' => $this->request->getPost('pkl_id'),
            'status' => $this->request->getPost('status'),
        ];

        $this->jurnalModel->insert($data);

        return redirect()->route('admin.jurnal.bimbingan.index')->with('success', 'Data jurnal bimbingan berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data = [
            'jurnal' => $this->jurnalModel->find($id),
        ];

        return view('admin/pkl/jurnal/bimbingan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jam' => $this->request->getPost('jam'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
            'pkl_id' => $this->request->getPost('pkl_id'),
            'status' => $this->request->getPost('status'),
        ];

        $this->jurnalModel->update($id, $data);

        return redirect()->route('admin.jurnal.bimbingan.index')->with('success', 'Data jurnal bimbingan berhasil diupdate');

    }

    public function delete($id)
    {
        $this->jurnalModel->delete($id);
 
        return redirect()->route('admin.jurnal.bimbingan.index')->with('success', 'Data jurnal bimbingan berhasil dihapus');

    }
}
