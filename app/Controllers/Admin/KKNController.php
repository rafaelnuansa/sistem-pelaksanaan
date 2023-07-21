<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KKNController extends BaseController
{
    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->pembimbing = new PembimbingModel();
        $this->anggota = new PKLAnggotaModel();
        $this->prodi = new ProdiModel();
        $this->kkn = new KKNModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $pklModel = new PKLModel();
        $pkls = $pklModel
            ->select('pkl.*, dosen.nama AS nama_dosen, prodi.nama_prodi')
            ->join('dosen', 'dosen.id = pkl.dosen_id')
            ->join('prodi', 'prodi.id = pkl.prodi_id')
            ->findAll();

        $mahasiswa = $this->mahasiswa->where('status_pkl', 'layak')->findAll();

        $kelompok_list = [];

        foreach ($pkls as $row) {
            $ketua_kelompok = $this->anggota->select('*')
                ->join('mahasiswa', 'mahasiswa.id = pkl_anggota.mahasiswa_id', 'left')
                ->where('pkl_anggota.pkl_id', $row['id'])
                ->where('pkl_anggota.is_ketua', true)
                ->first();
            $kelompok_list[] = [
                'id' => $row['id'],
                'nama_kelompok' => $row['nama_kelompok'],
                'tahun_akademik' => $row['tahun_akademik'],
                'tgl_mulai' => $row['tgl_mulai'],
                'tgl_selesai' => $row['tgl_selesai'],
                'nama_prodi' => $row['nama_prodi'],
                'nama_dosen' => $row['nama_dosen'],
                'nama_perusahaan' => $row['nama_perusahaan'],
                'ketua_kelompok' => ($ketua_kelompok) ? $ketua_kelompok['nama'] : 'Belum ada ketua',
            ];
        }
        $data = [
            'title' => 'Kelompok PKL',
            'pkls' => $kelompok_list,
            'mahasiswa' => $mahasiswa,
        ];

        return view('admin/pkl/index', $data);
    }

}
