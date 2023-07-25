<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SkripsiBimbinganController extends BaseController
{
    protected $jurnalModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->jurnalModel = new SkrpisiJurnal();
        $this->mahasiswaModel = new MahasiswaModel(); 
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasPKL();
        $data = [
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/skripsi/jurnal/bimbingan/index', $data);
    } 
}
