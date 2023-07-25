<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\SkripsiBimbinganModel;

class SkripsiBimbinganController extends BaseController
{
    protected $SkripsiBimbinganModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->SkripsiBimbinganModel = new SkripsiBimbinganModel();
        $this->mahasiswaModel = new MahasiswaModel(); 
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasPKL();
        $data = [
            'title' => 'Bimbingan Skripsi',
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/skripsi/jurnal/bimbingan/index', $data);
    }  

    public function show($id)
    {
        $jurnal = $this->SkripsiBimbinganModel->getJurnalBimbinganByIdMahasiswa($id);
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $id)->get()->getRow();
        // dd($mhs);
        $data = [
            'title' => 'Jurnal Bimbingan',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal
        ];
     
        return view('admin/pkl/jurnal/bimbingan/show', $data);
    }
    
}
