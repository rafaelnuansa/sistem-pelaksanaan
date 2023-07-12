<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // $total_pendaftaran = $this->kelompok_model
        //     ->groupBy('kelompok, tahun_akademik')
        //     ->findAll();
        // $total_pendaftaran = count($total_pendaftaran);
        // $total_bimbingan = $this->jurnal_bimbingan->countAll();
        // $total_jadwal = $this->jadwal_pkl->countAll();
        // $total_dosen = $this->dosen_pembimbing->countAll();

        $data = [
            'title' => 'Dashboard',
            // 'total_pendaftaran' => $total_pendaftaran,
            // 'total_bimbingan' => $total_bimbingan,
            // 'total_jadwal' => $total_jadwal,
            // 'total_dosen' => $total_dosen,
        ];

        return view('mahasiswa/dashboard/index', $data);
    }
}
