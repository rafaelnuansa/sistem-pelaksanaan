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
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasSkripsi();
        $data = [
            'title' => 'Bimbingan Skripsi',
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/skripsi/jurnal/bimbingan/index', $data);
    }  

    public function show($id)
    {
        $jurnal = $this->SkripsiBimbinganModel->getPembimbing1($id);
        $jurnal2 = $this->SkripsiBimbinganModel->getPembimbing2($id);
        $mhs = $this->db->table('mahasiswa')
        ->select('mahasiswa.*, p1.nama as nama_p1, p2.nama as nama_p2')
        ->join('skripsi', 'skripsi.mahasiswa_id = mahasiswa.id', 'left')
        ->join('dosen as p1', 'p1.id = skripsi.pembimbing_1_id', 'left')
        ->join('dosen as p2', 'p2.id = skripsi.pembimbing_2_id', 'left')
        ->where('mahasiswa.id', $id)
        ->get()
        ->getRow();
    
        
        $data = [
            'title' => 'Jurnal Bimbingan',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal,
            'jurnals2' => $jurnal2
        ];
     
        return view('admin/skripsi/jurnal/bimbingan/show', $data);
    }
    
}
