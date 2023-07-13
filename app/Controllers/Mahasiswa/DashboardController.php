<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->MahasiswaModel = new MahasiswaModel();
        $this->ProdiModel = new ProdiModel();
        $mahasiswaId = session()->get('mahasiswa_id');
        $mahasiswa = $this->MahasiswaModel->find($mahasiswaId);
    
        // Mengambil data prodi berdasarkan prodi_id pada mahasiswa
        $prodiId = $mahasiswa['prodi_id'];
        $prodi = $this->ProdiModel->find($prodiId);
        // Menambahkan data prodi ke dalam data mahasiswa
        $mahasiswa['prodi'] = $prodi['nama_prodi'];
    
        $data = [
            'title' => 'Dashboard',
            'mahasiswa' => $mahasiswa,
        ];
    
        return view('mahasiswa/dashboard/index', $data);
    }
    
    
}
