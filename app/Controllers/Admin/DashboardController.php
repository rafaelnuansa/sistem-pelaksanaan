<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;

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

       $data = [
            'title' => 'Dashboard',
            'fakultasCount' => $fakultasCount,
            'prodiCount' => $prodiCount,
            'mahasiswaCount' => $mahasiswaCount,
            'dosenCount' => $dosenCount,
        ];

        return view('admin/dashboard/index', $data);
    }
}
