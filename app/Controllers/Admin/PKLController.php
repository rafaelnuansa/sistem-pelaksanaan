<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\PKLAnggotaModel;
use App\Models\PKLModel;
use App\Models\ProdiModel;
use App\Models\PembimbingModel;

class PKLController extends BaseController
{
    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->pembimbing = new PembimbingModel();
        $this->anggota = new PKLAnggotaModel();
        $this->prodi = new ProdiModel();
        $this->pkl = new PKLModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $pklModel = new PKLModel();
        $pklsWithInstansi = $pklModel
            ->select('pkl.*, dosen.nama AS nama_dosen, prodi.nama_prodi, instansi.nama_perusahaan as nama_perusahaan, instansi.alamat as alamat_perusahaan')
            ->join('dosen', 'dosen.id = pkl.dosen_id')
            ->join('prodi', 'prodi.id = pkl.prodi_id')
            ->join('instansi', 'pkl.instansi_id = instansi.id', 'left')
            ->where('pkl.instansi_id >', 0)
            ->findAll();

        $pklsWithoutInstansi = $pklModel
            ->select('pkl.*, dosen.nama AS nama_dosen, prodi.nama_prodi, "Belum ada instansi" as nama_perusahaan, "Belum tersedia" as alamat_perusahaan', false)
            ->join('dosen', 'dosen.id = pkl.dosen_id')
            ->join('prodi', 'prodi.id = pkl.prodi_id')
            ->where('pkl.instansi_id', 0)
            ->findAll();

        $pkls = array_merge($pklsWithInstansi, $pklsWithoutInstansi);

        $mahasiswa = $this->mahasiswa->findAll();

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
                'alamat_perusahaan' => $row['alamat_perusahaan'],
                'bimbingan_perusahaan' => $row['bimbingan_perusahaan'],
                'jabatan_bimbingan_perusahaan' => $row['jabatan_bimbingan_perusahaan'],
                'no_perusahaan' => $row['no_perusahaan'],
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


    public function create()
    {
        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();

        $prodiModel = new ProdiModel();
        $prodis = $prodiModel->findAll();


        $data = [
            'title' => 'Tambah PKL',
            'dosens' => $dosens,
            'prodis' => $prodis,
        ];

        return view('admin/pkl/create', $data);
    }

    public function store()
    {
        $pklModel = new PKLModel();

        $data = [
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
            'dosen_id' => $this->request->getPost('dosen_id'),
            'prodi_id' => $this->request->getPost('prodi_id'),
        ];

        $pklModel->insert($data);

        return redirect()->to('/admin/pkl')->with('success', 'Data PKL berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pklModel = new PKLModel();
        $pkl = $pklModel->find($id);

        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();

        $prodiModel = new ProdiModel();
        $prodis = $prodiModel->findAll();

        $data = [
            'title' => 'Edit PKL',
            'pkl' => $pkl,
            'dosens' => $dosens,
            'prodis' => $prodis,
        ];

        return view('admin/pkl/edit', $data);
    }


    public function update($id)
    {
        $pklModel = new PKLModel();

        $data = [
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
            'dosen_id' => $this->request->getPost('dosen_id'),
            'prodi_id' => $this->request->getPost('prodi_id'),
        ];

        $pklModel->update($id, $data);

        return redirect()->to('/admin/pkl')->with('success', 'Data PKL berhasil diperbarui.');
    }

    public function delete($id)
    {
        $pklModel = new PKLModel();

        $pklModel->delete($id);

        return redirect()->to('/admin/pkl')->with('success', 'Data PKL berhasil dihapus.');
    }

    public function assignAnggota($kelompok_id)
    {
        $pkl = $this->pkl->find($kelompok_id);

    // Get the IDs of mahasiswa who are already in the kelompok
    $mahasiswaIdsInKelompok = $this->anggota
        ->select('mahasiswa_id')
        ->where('pkl_id', $kelompok_id)
        ->get()
        ->getResultArray();

    // Get the IDs of mahasiswa who are already in other kelompoks
    $mahasiswaIdsInOtherKelompok = $this->anggota
        ->select('mahasiswa_id')
        ->whereNotIn('pkl_id', [$kelompok_id]) // Exclude the current kelompok by passing it as an array
        ->groupBy('mahasiswa_id')
        ->get()
        ->getResultArray();

    // Combine the IDs of mahasiswa in both arrays
    $combinedMahasiswaIds = array_merge($mahasiswaIdsInKelompok, $mahasiswaIdsInOtherKelompok);

    // Fetch the available mahasiswa who are not in the kelompok or other kelompoks
    $query = $this->mahasiswa
        ->select('mahasiswa.id as id, mahasiswa.nim, mahasiswa.nama')
        ->join('pkl_anggota', 'mahasiswa.id = pkl_anggota.mahasiswa_id', 'left')
        ->where('mahasiswa.prodi_id', $pkl['prodi_id']);

    // Check if the array of IDs is not empty before using it in the query
    if (!empty($combinedMahasiswaIds)) {
        $mahasiswaIds = array_column($combinedMahasiswaIds, 'mahasiswa_id');
        $query = $query->whereNotIn('mahasiswa.id', $mahasiswaIds);
    }

    $mahasiswa = $query->get()->getResultArray();
        $rows = $this->anggota
            ->select('pkl_anggota.id as pkl_anggota_id, pkl.id as pkl_id, mahasiswa.id as mahasiswa_id, prodi.id as prodi_id, mahasiswa.*, pkl.*, prodi.*, pkl.*, pkl_anggota.*')
            ->where('pkl_id', $kelompok_id)
            ->join('pkl', 'pkl_anggota.pkl_id = pkl.id')
            ->join('mahasiswa', 'pkl_anggota.mahasiswa_id = mahasiswa.id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->get()
            ->getResultArray();

        $prodi = $this->prodi->find($pkl['prodi_id']);
        $dosen = $this->dosen->find($pkl['dosen_id']);

        $data = [
            'title' => 'Tambah Kelompok',
            'kelompok_id' => $kelompok_id,
            'kelompok' => $pkl['nama_kelompok'],
            'id_kelompok' => $pkl['id'],
            'prodi' => $prodi['nama_prodi'] ?? '-',
            'tgl_mulai' => $pkl['tgl_mulai'] ?? '-',
            'tgl_selesai' => $pkl['tgl_selesai'] ?? '-',
            'rows' => $rows,
            'mahasiswa' => $mahasiswa,
            'dospem' => $dosen['nama'] ?? '',
        ];

        return view('admin/pkl/assign_anggota', $data);
    }


    public function storeAnggota()
    {
        $pklAnggotaModel = new PKLAnggotaModel();

        $pkl_id = $this->request->getVar('pkl');
        $mahasiswa_id = $this->request->getVar('mahasiswa_id');

        $pklAnggotaModel->insert([
            'pkl_id' => $pkl_id,
            'mahasiswa_id' => $mahasiswa_id,
            'ketua' => false,
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan!');
        return redirect()->back()->with('success', 'Anggota PKL berhasil ditambahkan.');
    }

    public function deleteAnggota()
    {
        $pklAnggotaModel = new PKLAnggotaModel();
        $pklAnggotaModel->delete($this->request->getVar('id'));
        return redirect()->back()->with('success', 'Anggota PKL berhasil dihapus.');
    }


    public function statusAnggota()
    {
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $pkl_id = $this->request->getVar('pkl_id');
        // Cek apakah status yang dipilih adalah "Ketua"
        if ($status == 'Ketua') {
            // Cari anggota dengan status "Ketua" selain anggota yang sedang diubah
            $existingKetua = $this->anggota->where('is_ketua', 1)->where('pkl_id', $pkl_id)->get()->getRow();
            // dd($pkl_id);
            if ($existingKetua) {
                // Jika ditemukan anggota lain dengan status "Ketua", kembalikan response dengan error
                session()->setFlashdata('error', 'Hanya boleh ada satu anggota dengan status Ketua!');
                return redirect()->back();
            }
        }

        $data = $this->anggota->find($id);
        $data['is_ketua'] = ($status == 'Ketua') ? true : false;

        $this->anggota->save($data);
        session()->setFlashdata('success', 'Status berhasil diubah!');
        return redirect()->back();
    }
}
