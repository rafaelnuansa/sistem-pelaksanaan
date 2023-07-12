<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;
    protected $prodiModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaWithProdi();
 
        $data = [
            'title' => 'Daftar Mahasiswa',
            'mahasiswa' => $mahasiswa
        ];

        return view('admin/mahasiswa/index', $data);
    }

    public function create()
    {
        $prodi = $this->prodiModel->findAll();

        $data = [
            'title' => 'Tambah Mahasiswa',
            'prodi' => $prodi
        ];

        return view('admin/mahasiswa/create', $data);
    }

    public function store()
    {
        $validationRules = [
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'valid_email',
            'password' => 'required',
            'jenis_kelamin' => 'required',
            'no_telpon' => 'numeric',
            'tgl_lahir' => 'valid_date',
            'alamat' => 'required',
            'angkatan' => 'required|numeric',
            'status_akun' => 'required|in_list[0,1]',
            'prodi_id' => 'required|numeric',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $mahasiswaData = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'angkatan' => $this->request->getPost('angkatan'),
            'status_akun' => $this->request->getPost('status_akun'),
            'prodi_id' => $this->request->getPost('prodi_id'),
        ];
    
        $this->mahasiswaModel->insert($mahasiswaData);
    
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }
    

    public function edit($id)
    {
        $mahasiswa = $this->mahasiswaModel->find($id);
        $prodi = $this->prodiModel->findAll();

        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi
        ];

        return view('admin/mahasiswa/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'valid_email',
            'jenis_kelamin' => 'required',
            'no_telpon' => 'numeric',
            'tgl_lahir' => 'valid_date',
            'alamat' => 'required',
            'angkatan' => 'required|numeric',
            'status_akun' => 'required|in_list[0,1]',
            'prodi_id' => 'required|numeric',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $mahasiswaData = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'angkatan' => $this->request->getPost('angkatan'),
            'status_akun' => $this->request->getPost('status_akun'),
            'prodi_id' => $this->request->getPost('prodi_id'),
        ];
    
        // Periksa apakah password diisi atau tidak
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            // Jika password diisi, hash password baru
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $mahasiswaData['password'] = $hashedPassword;
        }
    
        $this->mahasiswaModel->update($id, $mahasiswaData);
    
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
    }
    
    public function delete($id)
    {
        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan');
        }

        $this->mahasiswaModel->delete($id);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
