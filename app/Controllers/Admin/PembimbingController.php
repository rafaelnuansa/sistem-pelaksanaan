<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembimbingModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;

class PembimbingController extends BaseController
{
    protected $pembimbingModel;
    protected $dosenModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->pembimbingModel = new PembimbingModel();
        $this->dosenModel = new DosenModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        // Menghitung jumlah dosen dan mahasiswa untuk setiap tipe bimbingan
        $jumlahDosenPKL = $this->pembimbingModel->where('tipe_bimbingan', 'PKL')->countAllResults();
        $jumlahMahasiswaPKL = $this->pembimbingModel->where('tipe_bimbingan', 'PKL')->countAllResults();

        $jumlahDosenKKN = $this->pembimbingModel->where('tipe_bimbingan', 'KKN')->countAllResults();
        $jumlahMahasiswaKKN = $this->pembimbingModel->where('tipe_bimbingan', 'KKN')->countAllResults();

        $jumlahDosenSkripsi = $this->pembimbingModel->where('tipe_bimbingan', 'SKRIPSI')->countAllResults();
        $jumlahMahasiswaSkripsi = $this->pembimbingModel->where('tipe_bimbingan', 'SKRIPSI')->countAllResults();

        $data = [
            'title' => 'Daftar Pembimbing',
            'jumlahDosenPKL' => $jumlahDosenPKL,
            'jumlahMahasiswaPKL' => $jumlahMahasiswaPKL,
            'jumlahDosenKKN' => $jumlahDosenKKN,
            'jumlahMahasiswaKKN' => $jumlahMahasiswaKKN,
            'jumlahDosenSkripsi' => $jumlahDosenSkripsi,
            'jumlahMahasiswaSkripsi' => $jumlahMahasiswaSkripsi
        ];

        return view('admin/pembimbing/index', $data);
    }

    public function create()
{
    $tipeBimbingan = $this->request->getGet('bimbingan');

    // Retrieve all records if no parameter is provided
    $pembimbing = $this->pembimbingModel
        ->join('mahasiswa', 'mahasiswa.id = pembimbing.mahasiswa_id')
        ->join('dosen', 'dosen.id = pembimbing.dosen_id');

    // Add condition if the parameter is provided
    if ($tipeBimbingan) {
        $pembimbing = $pembimbing->where('pembimbing.tipe_bimbingan', $tipeBimbingan);
    }

    $pembimbing = $pembimbing->findAll();
    $dosens = $this->dosenModel->findAll();
    $mahasiswas = $this->mahasiswaModel->findAll();

    $data = [
        'title' => 'Tambah Pembimbing ' . $tipeBimbingan,
        'dosens' => $dosens,
        'pembimbing' => $pembimbing,
        'mahasiswas' => $mahasiswas
    ];

    return view('admin/pembimbing/create', $data);
}



    public function store()
    {
        $validationRules = [
            'dosen_id' => 'required',
            'mahasiswa_id' => 'required',
            'tipe_bimbingan' => 'required|in_list[PKL,KKN,SKRIPSI]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pembimbingData = [
            'dosen_id' => $this->request->getPost('dosen_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'tipe_bimbingan' => $this->request->getPost('tipe_bimbingan'),
        ];

        $this->pembimbingModel->insert($pembimbingData);

        return redirect()->to('/admin/pembimbing')->with('success', 'Pembimbing berhasil ditambahkan');
    }


    public function edit($id)
    {
        $pembimbing = $this->pembimbingModel->find($id);
        $dosens = $this->dosenModel->findAll();
        $mahasiswas = $this->mahasiswaModel->findAll();

        if (!$pembimbing) {
            return redirect()->to('/admin/pembimbing')->with('error', 'Pembimbing tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Pembimbing',
            'pembimbing' => $pembimbing,
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas
        ];

        return view('admin/pembimbing/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'dosen_id' => 'required',
            'mahasiswa_id' => 'required',
            'tipe_bimbingan' => 'required|in_list[PKL,KKN,SKRIPSI]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pembimbingData = [
            'dosen_id' => $this->request->getPost('dosen_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'tipe_bimbingan' => $this->request->getPost('tipe_bimbingan'),
        ];

        $this->pembimbingModel->update($id, $pembimbingData);

        return redirect()->to('/admin/pembimbing')->with('success', 'Pembimbing berhasil diperbarui');
    }

    public function delete($id)
    {
        $pembimbing = $this->pembimbingModel->find($id);

        if (!$pembimbing) {
            return redirect()->to('/admin/pembimbing')->with('error', 'Pembimbing tidak ditemukan');
        }

        $this->pembimbingModel->delete($id);

        return redirect()->to('/admin/pembimbing')->with('success', 'Pembimbing berhasil dihapus');
    }
}
