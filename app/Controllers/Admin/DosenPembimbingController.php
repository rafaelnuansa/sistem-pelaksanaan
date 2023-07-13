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
        $validationRules = [
            'dosen_id' => 'required',
            'mahasiswa_id' => 'required',
            'jenis_pembimbing' => 'required|in_list[PKL,KKN,SKRIPSI]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $dosenId = $this->request->getPost('dosen_id');
        $mahasiswaId = $this->request->getPost('mahasiswa_id');
        $jenisPembimbing = $this->request->getPost('jenis_pembimbing');
    
        // Check if the mahasiswa already has a pembimbing for the given jenis pembimbing
        $existingPembimbing = $this->dosenPembimbingModel
            ->where('mahasiswa_id', $mahasiswaId)
            ->where('jenis_pembimbing', $jenisPembimbing)
            ->first();
    
        if ($existingPembimbing) {
            return redirect()->back()->withInput()->with('error', 'Mahasiswa sudah memiliki dosen pembimbing untuk jenis pembimbing ' . $jenisPembimbing);
        }
    
        $data = [
            'dosen_id' => $dosenId,
            'mahasiswa_id' => $mahasiswaId,
            'jenis_pembimbing' => $jenisPembimbing,
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
        $validationRules = [
            'dosen_id' => 'required',
            'mahasiswa_id' => 'required',
            'jenis_pembimbing' => 'required|in_list[PKL,KKN,SKRIPSI]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $dosenId = $this->request->getPost('dosen_id');
        $mahasiswaId = $this->request->getPost('mahasiswa_id');
        $jenisPembimbing = $this->request->getPost('jenis_pembimbing');
    
        // Check if the mahasiswa already has a pembimbing for the given jenis pembimbing
        $existingPembimbing = $this->dosenPembimbingModel
            ->where('mahasiswa_id', $mahasiswaId)
            ->where('jenis_pembimbing', $jenisPembimbing)
            ->where('id_dospem', '!=', $id_dospem)
            ->first();
    
        if ($existingPembimbing) {
            return redirect()->back()->withInput()->with('error', 'Mahasiswa sudah memiliki dosen pembimbing untuk jenis pembimbing ' . $jenisPembimbing);
        }
    
        $data = [
            'dosen_id' => $dosenId,
            'mahasiswa_id' => $mahasiswaId,
            'jenis_pembimbing' => $jenisPembimbing,
        ];
    
        $this->dosenPembimbingModel->update($id_dospem, $data);
    
        return redirect()->route('admin.dosen_pembimbing.index')->with('success', 'Data dosen pembimbing berhasil diperbarui');
    }
    

    public function delete($id_dospem)
    {
        $this->dosenPembimbingModel->delete($id_dospem);

        return redirect()->route('admin.dosen_pembimbing.index')->with('success', 'Data dosen pembimbing berhasil dihapus');
    }
}
