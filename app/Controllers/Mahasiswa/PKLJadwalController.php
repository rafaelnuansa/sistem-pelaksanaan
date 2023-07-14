<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
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
        $this->db = \Config\Database::connect();
    }

    public function index()
    {

        $jadwal_sidang = $this->db->table('pkl_jadwal_sidang')
            ->select('pkl_jadwal_sidang.*, mahasiswa.nim as nim,  dosen_pembimbing.*, mahasiswa.nama as nama_mahasiswa, dosen.nama as dospeng, dosen_penguji.nama as penguji, tempat_sidang.nama_tempat as tempat_nama')
            ->join('mahasiswa', 'mahasiswa.id = pkl_jadwal_sidang.mahasiswa_id', 'left')
            ->join('tempat_sidang', 'tempat_sidang.id_tempat = pkl_jadwal_sidang.tempat_id', 'left')
            ->join('dosen_pembimbing', 'dosen_pembimbing.mahasiswa_id = mahasiswa.id', 'left')
            ->join('dosen', 'dosen.id = pkl_jadwal_sidang.dospeng_id', 'left')
            ->join('dosen as dosen_penguji', 'dosen_penguji.id = dosen_pembimbing.dosen_id', 'left')
            ->where('pkl_jadwal_sidang.mahasiswa_id', $this->mahasiswaId)
            ->where('dosen_pembimbing.mahasiswa_id', $this->mahasiswaId)
            ->groupBy('pkl_jadwal_sidang.tanggal')
            ->get()
            ->getResultArray();

        // dd($this->mahasiswaId);

        $persyaratan = $this->PKLUjianModel->where('mahasiswa_id', $this->mahasiswaId)->findAll();
        $data = [
            'title' => 'Jadwal Sidang',
            'data' =>  $jadwal_sidang,
            'persyaratan' => $persyaratan,
            'jurusan' => $this->ProdiModel->findAll(),

        ];
        return view('mahasiswa/pkl/jadwal-sidang', $data);
    }

    public function daftar()
    {
        $ujianModel = new PKLUjianModel();
        // Periksa apakah mahasiswa sudah melakukan pendaftaran sebelumnya
        $isDaftar = $ujianModel->where('mahasiswa_id', session()->get('mahasiswa_id'))->first();

        // Jika mahasiswa sudah melakukan pendaftaran sebelumnya
        if ($isDaftar) {
            // Mengambil nama mahasiswa dari session dan mengubahnya menjadi lowercase
            $namaMahasiswa = strtolower(session()->get('nama'));
            // Mengganti spasi dengan garis bawah
            $namaMahasiswa = str_replace(' ', '_', $namaMahasiswa);
            // Mengganti karakter lain dengan garis bawah
            $namaMahasiswa = preg_replace('/[^a-zA-Z0-9]/', '_', $namaMahasiswa);

            // Mengambil data file lampiran yang ada
            $lampiran = [
                'lampiran_pembayaran' => $isDaftar['lampiran_pembayaran'],
                'lampiran_krs' => $isDaftar['lampiran_krs'],
                'lampiran_laporan' => $isDaftar['lampiran_laporan'],
                'lampiran_keterangan' => $isDaftar['lampiran_keterangan']
            ];

            // Mengambil data file lampiran yang baru diunggah
            $newLampiran = [
                'lampiran_pembayaran' => $this->request->getFile('lampiran_pembayaran'),
                'lampiran_krs' => $this->request->getFile('lampiran_krs'),
                'lampiran_laporan' => $this->request->getFile('lampiran_laporan'),
                'lampiran_keterangan' => $this->request->getFile('lampiran_keterangan')
            ];

            // Mengupdate lampiran yang ada dengan file baru jika ada
            foreach ($newLampiran as $key => $file) {
                // Cek apakah file lampiran baru diunggah
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    // Menghapus file lampiran yang lama
                    // unlink('uploads/pkl/' . $lampiran[$key]);

                    // Menyiapkan nama file lampiran dengan format: nama_mahasiswa_lampiran.extensi
                    $ext = $file->getClientExtension();
                    $newFileName = $namaMahasiswa . '_lampiran_' . $key . '.' . $ext;

                    // Memindahkan file lampiran baru ke folder yang ditentukan
                    $file->move('uploads/pkl/', $newFileName);

                    // Mengupdate data lampiran dengan nama file yang baru
                    $isDaftar[$key] = $newFileName;
                }
            }

            // Menyimpan data lampiran yang telah diupdate
            $ujianModel->save($isDaftar);

            session()->setFlashdata('success', 'Berhasil mengupdate lampiran');
            return redirect()->to('/mahasiswa/pkl/jadwal');
        }

        $namaMahasiswa = strtolower(session()->get('nama'));
        // Mengganti spasi dengan garis bawah
        $namaMahasiswa = str_replace(' ', '_', $namaMahasiswa);
        // Mengganti karakter lain dengan garis bawah
        $namaMahasiswa = preg_replace('/[^a-zA-Z0-9]/', '_', $namaMahasiswa);
        // Mahasiswa belum melakukan pendaftaran sebelumnya, maka jalankan kode pendaftaran baru
        $lampiran_pembayaran = $this->request->getFile('lampiran_pembayaran');
        $lampiran_krs = $this->request->getFile('lampiran_krs');
        $lampiran_laporan = $this->request->getFile('lampiran_laporan');
        $lampiran_keterangan = $this->request->getFile('lampiran_keterangan');

        // Menyiapkan variabel untuk menyimpan nama file lampiran
        $file2 = '';
        $file3 = '';
        $file4 = '';
        $file5 = '';

        // Mengunggah file lampiran pembayaran jika ada
        if ($lampiran_pembayaran && $lampiran_pembayaran->isValid() && !$lampiran_pembayaran->hasMoved()) {
            $file2 = $namaMahasiswa . '_lampiran_pembayaran.' . $lampiran_pembayaran->getClientExtension();
            $lampiran_pembayaran->move('uploads/pkl/', $file2);
        }

        // Mengunggah file lampiran KRS jika ada
        if ($lampiran_krs && $lampiran_krs->isValid() && !$lampiran_krs->hasMoved()) {
            $file3 = $namaMahasiswa . '_lampiran_krs.' . $lampiran_krs->getClientExtension();
            $lampiran_krs->move('uploads/pkl/', $file3);
        }

        // Mengunggah file lampiran laporan jika ada
        if ($lampiran_laporan && $lampiran_laporan->isValid() && !$lampiran_laporan->hasMoved()) {
            $file4 = $namaMahasiswa . '_lampiran_laporan.' . $lampiran_laporan->getClientExtension();
            $lampiran_laporan->move('uploads/pkl/', $file4);
        }

        // Mengunggah file lampiran keterangan jika ada
        if ($lampiran_keterangan && $lampiran_keterangan->isValid() && !$lampiran_keterangan->hasMoved()) {
            $file5 = $namaMahasiswa . '_lampiran_keterangan.' . $lampiran_keterangan->getClientExtension();
            $lampiran_keterangan->move('uploads/pkl/', $file5);
        }

        $data = [
            'nama' => session()->get('nama'),
            'lampiran_pembayaran' => $file2,
            'lampiran_krs' => $file3,
            'lampiran_laporan' => $file4,
            'lampiran_keterangan' => $file5,
            'mahasiswa_id' => session()->get('mahasiswa_id')
        ];

        $ujianModel->insert($data);

        session()->setFlashdata('success', 'Berhasil melakukan pendaftaran');
        return redirect()->to('/mahasiswa/pkl/jadwal');
    }
}
