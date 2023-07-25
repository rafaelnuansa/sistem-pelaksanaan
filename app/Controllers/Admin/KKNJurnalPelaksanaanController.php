<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\KKNJurnalPelaksanaanModel;

class KKNJurnalPelaksanaanController extends BaseController
{
    protected $jurnalModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->jurnalModel = new KKNJurnalPelaksanaanModel();
        $this->mahasiswaModel = new MahasiswaModel(); 
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasKKN();
        // dd($mahasiswa);
        $data = [
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/kkn/jurnal/pelaksanaan/index', $data);
    }

    public function show($id)
    { 
        $jurnal = $this->jurnalModel->getJurnalPelaksanaanByIdMahasiswa($id);
        
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $id)->get()->getRow();
        $data = [
            'title' => 'Jurnal Pelaksanaan',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal
        ];
    
        return view('admin/kkn/jurnal/pelaksanaan/show', $data);
    }
    
    public function create()
    {
        return view('admin/kkn/jurnal/pelaksanaan/create');
    }

    public function store()
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jam' => $this->request->getPost('jam'),
            'hari' => $this->request->getPost('hari'),
            'keterangan' => $this->request->getPost('keterangan'),
            'kkn_id' => $this->request->getPost('kkn_id'),
        ];

        $this->jurnalModel->insert($data);

        return redirect()->route('admin.jurnal.pelaksanaan.index')->with('success', 'Data jurnal pelaksanaan berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data = [
            'jurnal' => $this->jurnalModel->find($id),
        ];

        return view('admin/kkn/jurnal/pelaksanaan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'jam' => $this->request->getPost('jam'),
            'hari' => $this->request->getPost('hari'),
            'keterangan' => $this->request->getPost('keterangan'),
            'kkn_id' => $this->request->getPost('kkn_id'),
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
