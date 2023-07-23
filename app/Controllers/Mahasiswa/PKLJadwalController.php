<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\PKLAnggotaModel;
use App\Models\PKLJadwalModel;
use App\Models\PKLUjianModel;
use App\Models\ProdiModel;
use Dompdf\Dompdf;

class PKLJadwalController extends BaseController
{

    public function __construct()
    {
        $this->pdf = new Dompdf();

        $this->PKLJadwalModel = new PKLJadwalModel();
        $this->ProdiModel = new ProdiModel();
        $this->PKLUjianModel = new PKLUjianModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->AnggotaModel = new PKLAnggotaModel();
        $this->getKelompok = $this->AnggotaModel->getKelompokIdBySessionIdMhs();
        if ($this->getKelompok) {
            $this->kelompokId = $this->getKelompok->id;
        }
        $this->db = \Config\Database::connect();
    }

    public function index()
    {

        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
        ->select('pkl_jadwal_sidang.*, pkl_nilai_sidang.*, fakultas.nama as fakultas, dospem.nama as dospem, prodi.nama_prodi as prodi, dosen.nama as nama_dosen, pkl.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.nim as nim, mahasiswa.angkatan as angkatan, pkl_judul_laporan.judul_laporan as judul_laporan, tempat_sidang.nama_tempat as tempat_nama, dosen.nama as dospeng, dosen.nidn as nidn')
        ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id')
        ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id')
        ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
        ->join('fakultas', 'fakultas.id = prodi.fakultas_id')
        ->join('pkl_anggota', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
        ->join('pkl', 'pkl.id = pkl_anggota.pkl_id')
        ->join('dosen as dospem', 'dospem.id = pkl.dosen_id')
        ->join('pkl_judul_laporan', 'pkl_judul_laporan.mahasiswa_id = mahasiswa.id')
        ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id')
        ->join('pkl_nilai_sidang', 'pkl_jadwal_sidang.id_pkl_jadwal_sidang = pkl_nilai_sidang.sidang_id', 'left') // Use left join instead of inner join
        ->where('pkl_jadwal_sidang.mahasiswa_id', $this->mahasiswaId)
        ->groupBy('pkl_jadwal_sidang.tanggal')
        ->get()
        ->getResultArray();
    
// dd($jadwal_sidang);
        $persyaratan = $this->PKLUjianModel->where('mahasiswa_id', $this->mahasiswaId)->findAll();
        $data = [
            'title' => 'Jadwal Sidang',
            'data' =>  $jadwal_sidang,
            'persyaratan' => $persyaratan,
            'jurusan' => $this->ProdiModel->findAll(),
            'kelompokId' => $this->kelompokId ?? null,

        ];

        return view('mahasiswa/pkl/jadwal-sidang', $data);
    }

    public function daftar()
    {
        $ujianModel = new PKLUjianModel();
        $mahasiswaId = session()->get('mahasiswa_id');

        // Check if the student has registered before
        $isRegistered = $ujianModel->where('mahasiswa_id', $mahasiswaId)->first();

        // If the student has registered before
        if ($isRegistered) {
            // File fields and their corresponding database columns
            $lampiranFields = [
                'kwitansi',
                'krs',
                'laporan',
                'sk_pkl'
            ];

            // Upload and update lampiran files if they are provided
            foreach ($lampiranFields as $field) {
                $file = $this->request->getFile($field);

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $fileExtension = $file->getClientExtension();
                    $newFileName = $this->generateUniqueFileName($fileExtension);
                    $file->move('uploads/pkl/', $newFileName);
                    $isRegistered[$field] = $newFileName;
                }
            }

            // Save the updated lampiran data
            $ujianModel->save($isRegistered);

            session()->setFlashdata('success', 'Berhasil mengupdate lampiran');
            return redirect()->to('/mahasiswa/pkl/jadwal');
        }

        // If the student hasn't registered before
        $data = [
            'nama' => session()->get('nama'),
            'mahasiswa_id' => $mahasiswaId
        ];

        // File fields and their corresponding database columns
        $lampiranFields = [
            'kwitansi',
            'krs',
            'laporan',
            'sk_pkl'
        ];

        // Upload and store lampiran files if they are provided
        foreach ($lampiranFields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileExtension = $file->getClientExtension();
                $newFileName = $this->generateUniqueFileName($fileExtension);
                $file->move('uploads/pkl/', $newFileName);
                $data[$field] = $newFileName;
            }
        }

        $ujianModel->insert($data);

        session()->setFlashdata('success', 'Berhasil melakukan pendaftaran');
        return redirect()->to('/mahasiswa/pkl/jadwal');
    }

    private function generateUniqueFileName($extension)
    {
        $timestamp = date('YmdHis');
        $randomString = bin2hex(random_bytes(8));
        $fileName = $timestamp . '_' . $randomString . '.' . $extension;
        return $fileName;
    }
}
