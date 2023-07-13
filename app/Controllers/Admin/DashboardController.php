<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\DosenPembimbingModel;
use App\Models\PKLJadwalModel;
use App\Models\PKLJurnalBimbinganModel;
use App\Models\PKLModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $fakultasModel = new FakultasModel();
        $fakultasCount = $fakultasModel->countAllResults();

        $prodiModel = new ProdiModel();
        $prodiCount = $prodiModel->countAllResults();

        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaCount = $mahasiswaModel->countAllResults();

        $dosenModel = new DosenModel();
        $dosenCount = $dosenModel->countAllResults();

        $pkl = new PKLModel();
        $pklCount = $pkl->countAllResults();

        $pklBimb = new DosenPembimbingModel();
        $pklBimbCount = $pklBimb->countAllResults();
        
        $pklJadwal = new PKLJadwalModel();
        $pklJadwalCount = $pklJadwal->countAllResults();

       $data = [
            'title' => 'Dashboard',
            'fakultasCount' => $fakultasCount,
            'prodiCount' => $prodiCount,
            'mahasiswaCount' => $mahasiswaCount,
            'dosenCount' => $dosenCount,
            'pklCount' => $pklCount,
            'pklBimbCount' => $pklBimbCount,
            'pklJadwalCount' => $pklJadwalCount
        ];

        return view('admin/dashboard/index', $data);
    }
}
