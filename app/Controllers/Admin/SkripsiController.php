<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\SkripsiModel;
use App\Models\ProdiModel;
use App\Models\PembimbingModel;

class SkripsiController extends BaseController
{
    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->pembimbing = new PembimbingModel();
        $this->prodi = new ProdiModel();
        $this->skripsiModel = new SkripsiModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'prodiList' => $this->prodi->findAll(),
            'title' => 'SKRIPSI',
        ];

        return view('admin/skripsi/index', $data);
    }
    public function skripsi_ajax()
    {
        $skripsiModel = new SkripsiModel();

        // Get the parameters sent by DataTables
        $draw = $this->request->getVar('draw');
        $start = $this->request->getVar('start');
        $length = $this->request->getVar('length');
        $search = $this->request->getVar('search')['value'];
        $prodi_id = $this->request->getPost('prodi_id'); // Add the Prodi filter

        // Prepare the query for server-side processing
        $skripsiModel->select('skripsi.*, pembimbing1.nama AS nama_pembimbing_1, pembimbing2.nama AS nama_pembimbing_2, prodi.nama_prodi, mahasiswa.nim, mahasiswa.nama as nama_mahasiswa, skripsi.id as id') // Include 'nim' in the SELECT statement
            ->join('dosen as pembimbing1', 'pembimbing1.id = skripsi.pembimbing_1_id')
            ->join('dosen as pembimbing2', 'pembimbing2.id = skripsi.pembimbing_2_id')
            ->join('mahasiswa', 'mahasiswa.id = skripsi.mahasiswa_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id');

        // Apply search if there's any
        if (!empty($search)) {
            $skripsiModel->groupStart()
                ->like('mahasiswa.nama', $search)
                ->orLike('mahasiswa.nim', $search)
                ->orLike('pembimbing1.nama', $search)
                ->orLike('pembimbing2.nama', $search)
                // Add more fields to be searched
                ->groupEnd();
        }

        // Apply Prodi filter if selected
        if (!empty($prodi_id)) {
            $skripsiModel->where('prodi.id', $prodi_id);
        }

        // Get filtered records
        $skripsis = $skripsiModel
            ->orderBy('skripsi.id', 'desc') // You can change the order as needed
            ->limit($length, $start)
            ->findAll();

        // Add row index to the data array
        $startIndex = $start + 1;
        foreach ($skripsis as $index => $skripsi) {
            $skripsis[$index]['DT_RowIndex'] = $startIndex++;
        }

        $data = [
            'draw' => $draw,
            'recordsTotal' => $skripsiModel->countAll(),
            'recordsFiltered' => $skripsiModel->countAllResults(),
            'data' => $skripsis,
        ];

        // Return the data in JSON format
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();

        $prodiModel = new ProdiModel();
        $prodis = $prodiModel->findAll();


        $mahasiswaModel = new MahasiswaModel();
        $mahasiswas = $mahasiswaModel->findAll();

        $data = [
            'title' => 'Tambah Skripsi',
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas,
            'prodis' => $prodis,
        ];

        return view('admin/skripsi/create', $data);
    }

    public function store()
    {
        $skripsiModel = new SkripsiModel();

        $mahasiswa_id = $this->request->getPost('mahasiswa_id');
        $tahun_akademik = $this->request->getPost('tahun_akademik');

        try {
            // Cek apakah sudah ada data skripsi mahasiswa dengan ID dan tahun akademik yang diinputkan
            $existingSkripsi = $skripsiModel->where('mahasiswa_id', $mahasiswa_id)->where('tahun_akademik', $tahun_akademik)->first();

            if ($existingSkripsi) {
                // Ambil nama mahasiswa dari database berdasarkan mahasiswa_id
                $mahasiswaModel = new MahasiswaModel();
                $mahasiswa = $mahasiswaModel->find($mahasiswa_id);

                // Jika sudah ada data skripsi mahasiswa, tampilkan pesan dan batalkan proses penyimpanan
                return redirect()->back()->withInput()->with('error', ' (' . $mahasiswa['nama'] . ') pada tahun tersebut telah terdaftar dalam Skripsi.');
            }

            // Jika belum ada data skripsi mahasiswa, lakukan penyimpanan data skripsi
            $data = [
                'mahasiswa_id' => $mahasiswa_id,
                'tahun_akademik' => $tahun_akademik,
                'pembimbing_1_id' => $this->request->getPost('pembimbing_1_id'),
                'pembimbing_2_id' => $this->request->getPost('pembimbing_2_id'),
            ];

            // Check if Pembimbing 1 and Pembimbing 2 are the same
            if ($data['pembimbing_1_id'] == $data['pembimbing_2_id']) {
                return redirect()->back()->withInput()->with('error', 'Pembimbing 1 dan Pembimbing 2 tidak boleh sama.');
            }

            $skripsiModel->insert($data);
            return redirect()->to('/admin/skripsi')->with('success', 'Data Skripsi berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangani pengecualian jika terjadi kesalahan dalam proses penyimpanan
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }



    public function edit($id)
    {
        $skripsiModel = new SkripsiModel();
        $skripsi = $skripsiModel->find($id);

        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();


        $mahasiswaModel = new MahasiswaModel();
        $mahasiswas = $mahasiswaModel->findAll();

        $data = [
            'title' => 'Edit Skripsi',
            'skripsi' => $skripsi,
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas,
        ];

        return view('admin/skripsi/edit', $data);
    }


    public function update($id)
    {
        try {
            $skripsiModel = new SkripsiModel();

            // Dapatkan data skripsi yang akan diupdate dari database
            $skripsi = $skripsiModel->find($id);

            if (!$skripsi) {
                return redirect()->to('/admin/skripsi')->with('error', 'Data Skripsi tidak ditemukan.');
            }

            // Dapatkan mahasiswa_id dari form input
            $mahasiswa_id = $this->request->getPost('mahasiswa_id');

            // Jika mahasiswa_id berubah, cek apakah mahasiswa dengan ID baru sudah terdaftar dalam skripsi
            if ($mahasiswa_id != $skripsi['mahasiswa_id']) {
                $existingSkripsi = $skripsiModel->where('mahasiswa_id', $mahasiswa_id)->first();

                if ($existingSkripsi) {
                    // Ambil nama mahasiswa dari database berdasarkan mahasiswa_id baru
                    $mahasiswaModel = new MahasiswaModel();
                    $mahasiswa = $mahasiswaModel->find($mahasiswa_id);

                    // Tampilkan pesan jika mahasiswa dengan ID baru sudah terdaftar dalam skripsi
                    return redirect()->back()->withInput()->with('error', '(' . $mahasiswa['nama'] . ') telah terdaftar dalam Skripsi.');
                }
            }

            // Jika tidak ada masalah, lakukan proses update data skripsi
            $data = [
                'mahasiswa_id' => $mahasiswa_id,
                'pembimbing_1_id' => $this->request->getPost('pembimbing_1_id'),
                'pembimbing_2_id' => $this->request->getPost('pembimbing_2_id'),
            ];


            // Check if Pembimbing 1 and Pembimbing 2 are the same
            if ($data['pembimbing_1_id'] == $data['pembimbing_2_id']) {
                return redirect()->back()->withInput()->with('error', 'Pembimbing 1 dan Pembimbing 2 tidak boleh sama.');
            }

            $skripsiModel->update($id, $data);

            return redirect()->to('/admin/skripsi')->with('success', 'Data Skripsi berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani exception jika terjadi kesalahan dalam proses update
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $skripsiModel = new SkripsiModel();

        $skripsiModel->delete($id);

        return redirect()->to('/admin/skripsi')->with('success', 'Data Skripsi berhasil dihapus.');
    }
}
