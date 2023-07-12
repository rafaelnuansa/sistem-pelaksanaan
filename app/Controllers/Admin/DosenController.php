<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class DosenController extends BaseController
{
    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $dosen = $this->dosenModel->orderBy('id', 'desc')->findAll();

        $data = [
            'title' => 'Daftar Dosen',
            'dosen' => $dosen
        ];

        return view('admin/dosen/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Dosen'
        ];

        return view('admin/dosen/create', $data);
    }

    public function store()
    {
        $validationRules = [
            'nama' => 'required',
            'nidn' => 'required|is_unique[dosen.nidn]',
            'email' => 'valid_email',
            'password' => 'required',
            'no_telpon' => 'numeric',
            'alamat' => 'required',
            'status_akun' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dosenData = [
            'nama' => $this->request->getPost('nama'),
            'nidn' => $this->request->getPost('nidn'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'alamat' => $this->request->getPost('alamat'),
            'status_akun' => $this->request->getPost('status_akun'),
        ];

        $this->dosenModel->insert($dosenData);

        return redirect()->to('/admin/dosen')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dosen = $this->dosenModel->find($id);

        if (!$dosen) {
            return redirect()->to('/admin/dosen')->with('error', 'Dosen tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosen
        ];

        return view('admin/dosen/edit', $data);
    }

    public function update($id)
    { 
        // dd($id);
        $validationRules = [
            'nama' => 'required',
            'nidn' => "required|is_unique[dosen.nidn,id,$id]",
            'email' => 'valid_email',
            'no_telpon' => 'numeric',
            'alamat' => 'required',
            'status_akun' => 'required|in_list[0,1]',
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $validationRules['password'] = 'required';
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dosenData = [
            'nama' => $this->request->getPost('nama'),
            'nidn' => $this->request->getPost('nidn'),
            'email' => $this->request->getPost('email'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'alamat' => $this->request->getPost('alamat'),
            'status_akun' => $this->request->getPost('status_akun'),
        ];

        if (!empty($password)) {
            $dosenData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->dosenModel->update($id, $dosenData);

        return redirect()->to('/admin/dosen')->with('success', 'Dosen berhasil diperbarui');
    }

    public function delete($id)
    {
        $dosen = $this->dosenModel->find($id);

        if (!$dosen) {
            return redirect()->to('/admin/dosen')->with('error', 'Dosen tidak ditemukan');
        }

        $this->dosenModel->delete($id);

        return redirect()->to('/admin/dosen')->with('success', 'Dosen berhasil dihapus');
    }
}
