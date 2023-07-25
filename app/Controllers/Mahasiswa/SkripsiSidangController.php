<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\SkripsiModel;
use App\Models\SkripsiPersyaratanModel;
use App\Models\SkripsiSidangModel;
use Dompdf\Dompdf;

class SkripsiSidangController extends BaseController
{
    public function __construct()
    {
        $this->pdf = new Dompdf();

        $this->SkripsiSidangModel = new SkripsiSidangModel();
        $this->ProdiModel = new ProdiModel();
        $this->SkripsiModel = new SkripsiModel();
        $this->persyaratanModel = new SkripsiPersyaratanModel();
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->getSkripsi = $this->SkripsiModel->getSkripsiSessionMhs();
        if ($this->getSkripsi) {
            $this->skripsiId = $this->getSkripsi->id;
        }
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $jadwalSidang = $this->SkripsiModel->getSidangSessionMhs();
        $persyaratan = $this->persyaratanModel->where('mahasiswa_id', $this->mahasiswaId)->findAll();

        $data = [
            'title' => 'Jadwal Sidang',
            'data' =>  $jadwalSidang,
            'persyaratan' => $persyaratan,
            'jurusan' => $this->ProdiModel->findAll(),
            'skripsiId' => $this->skripsiId ?? null,

        ];

        return view('mahasiswa/skripsi/sidang', $data);
    }  

    public function daftar()
    {
        $persyaratanModel = new SkripsiPersyaratanModel();
        $mahasiswaId = session()->get('mahasiswa_id');

        // Check if the student has registered before
        $isRegistered = $persyaratanModel->where('mahasiswa_id', $mahasiswaId)->first();

        // If the student has registered before
        if ($isRegistered) {
            // File fields and their corresponding database columns
            $lampiranFields = [
                'kwitansi',
                'krs',
                'laporan',
                'sk_skripsi'
            ];

            // Upload and update lampiran files if they are provided
            foreach ($lampiranFields as $field) {
                $file = $this->request->getFile($field);

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $fileExtension = $file->getClientExtension();
                    $newFileName = $this->generateUniqueFileName($fileExtension);
                    $file->move('uploads/skripsi/', $newFileName);
                    $isRegistered[$field] = $newFileName;
                }
            }

            // Save the updated lampiran data
            $persyaratanModel->save($isRegistered);

            session()->setFlashdata('success', 'Berhasil mengupdate lampiran');
            return redirect()->back();
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
            'sk_skripsi'
        ];

        // Upload and store lampiran files if they are provided
        foreach ($lampiranFields as $field) {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileExtension = $file->getClientExtension();
                $newFileName = $this->generateUniqueFileName($fileExtension);
                $file->move('uploads/skripsi/', $newFileName);
                $data[$field] = $newFileName;
            }
        }

        $persyaratanModel->insert($data);

        session()->setFlashdata('success', 'Berhasil melakukan pendaftaran');
        return redirect()->back();
    } 

    private function generateUniqueFileName($extension)
    {
        $timestamp = date('YmdHis');
        $randomString = bin2hex(random_bytes(8));
        $fileName = $timestamp . '_' . $randomString . '.' . $extension;
        return $fileName;
    }
}
