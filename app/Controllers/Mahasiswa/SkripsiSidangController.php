<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\SkripsiModel;
use App\Models\SkripsiSemhasModel;
use App\Models\SkripsiSemproModel;
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
        $this->mahasiswaId = session()->get('mahasiswa_id');
        $this->getSkripsi = $this->SkripsiModel->getSkripsiSessionMhs();
        if ($this->getSkripsi) {
            $this->skripsiId = $this->getSkripsi->id;
        }
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        
        $jadwalSidangSemhas = $this->SkripsiModel->getSidangSemhasSessionMhs();
        $jadwalSidangSempro= $this->SkripsiModel->getSidangSemproSessionMhs();
        // Check if the student has registered before
        $mahasiswaId = session()->get('mahasiswa_id');
        $isRegisteredSemhas = $this->db->table('skripsi_semhas')->where('mahasiswa_id', $mahasiswaId)->get()->getResultArray();
        $isRegisteredSempro = $this->db->table('skripsi_sempro')->where('mahasiswa_id', $mahasiswaId)->get()->getResultArray();
        // dd($isRegisteredSempro);
        $data = [
            'title' => 'Jadwal Sidang Skripsi',
            'seminar_hasil' =>  $jadwalSidangSemhas,
            'seminar_proposal' =>  $jadwalSidangSempro,
            'register_semhas' => $isRegisteredSemhas,
            'register_sempro' => $isRegisteredSempro,
            'jurusan' => $this->ProdiModel->findAll(),
            'skripsiId' => $this->skripsiId ?? null,
        ];

        return view('mahasiswa/skripsi/sidang', $data);
    }  

    public function daftar_semhas()
    {
        $skripsiSemhasModel = new SkripsiSemhasModel();
        $mahasiswaId = session()->get('mahasiswa_id');
    
        // Check if the student has registered before
        $isRegistered = $skripsiSemhasModel->where('mahasiswa_id', $mahasiswaId)->first();
        // If the student has registered before
        if ($isRegistered) {
            // File fields and their corresponding database columns
            $lampiranFields = [
                'transkrip_nilai',
                'krs',
                'sertifikat_seminar_kompetensi',
                'nota_dinas_pembimbing',
                'kartu_bimbingan_skripsi',
                'kartu_peserta_seminar_proposal',
                'sertifikat_mampram_ospek',
                'sertifikat_outbound',
                'sertifikat_toefl',
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
            $skripsiSemhasModel->save($isRegistered);
    
            session()->setFlashdata('success', 'Berhasil mengupdate lampiran');
            return redirect()->back();
        }
    
        // If the student hasn't registered before
        $data = [
            'mahasiswa_id' => $mahasiswaId,
            'status' => 'Pending',
        ];
    
        // File fields and their corresponding database columns
        $lampiranFields = [
            'transkrip_nilai',
            'krs',
            'sertifikat_seminar_kompetensi',
            'nota_dinas_pembimbing',
            'kartu_bimbingan_skripsi',
            'kartu_peserta_seminar_proposal',
            'sertifikat_mampram_ospek',
            'sertifikat_outbound',
            'sertifikat_toefl',
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
    
        $skripsiSemhasModel->insert($data);
    
        session()->setFlashdata('success', 'Berhasil melakukan pendaftaran');
        return redirect()->back();
    }
     
 
    public function daftar_sempro()
    {
        $skripsiSemproModel = new SkripsiSemproModel();
        $mahasiswaId = session()->get('mahasiswa_id');
    
        // Check if the student has registered before
        $isRegistered = $skripsiSemproModel->where('mahasiswa_id', $mahasiswaId)->first();
        
        // dd($isRegistered);
        // If the student has registered before
        if ($isRegistered) {
            // File fields and their corresponding database columns
            $lampiranFields = [
                'transkrip_nilai',
                'krs',
                'sertifikat_seminar_kompetensi',
                'nota_dinas_pembimbing',
                'kartu_bimbingan_skripsi',
                'kartu_peserta_seminar_proposal'
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
            $skripsiSemproModel->save($isRegistered);
    
            session()->setFlashdata('success', 'Berhasil mengupdate lampiran');
            return redirect()->back();
        }
    
        // If the student hasn't registered before
        $data = [
            'mahasiswa_id' => $mahasiswaId,
            'status' => 'Pending',
        ];
    
        // File fields and their corresponding database columns
        $lampiranFields = [
            'transkrip_nilai',
            'krs',
            'sertifikat_seminar_kompetensi',
            'nota_dinas_pembimbing',
            'kartu_bimbingan_skripsi',
            'kartu_peserta_seminar_proposal'
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
    
        $skripsiSemproModel->insert($data);
    
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
