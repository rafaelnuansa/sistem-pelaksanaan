<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\KKNAnggotaModel;
use App\Models\KKNModel;
use App\Models\ProdiModel;
use App\Models\PembimbingModel;

class KKNController extends BaseController
{
    public function __construct()
    {
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->pembimbing = new PembimbingModel();
        $this->anggota = new KKNAnggotaModel();
        $this->prodi = new ProdiModel();
        $this->kkn = new KKNModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $kknModel = new KKNModel();
        $kknsWithInstansi = $kknModel
            ->select('kkn.*, dosen.nama AS nama_dosen, prodi.nama_prodi, kkn_lokasi.nama_lokasi as nama_lokasi, kkn_lokasi.alamat_lokasi as alamat_lokasi')
            ->join('dosen', 'dosen.id = kkn.dosen_id')
            ->join('prodi', 'prodi.id = kkn.prodi_id')
            ->join('kkn_lokasi', 'kkn.lokasi_id = kkn_lokasi.id', 'left')
            ->where('kkn.lokasi_id >', 0)
            ->findAll();

        $kknsWithoutInstansi = $kknModel
            ->select('kkn.*, dosen.nama AS nama_dosen, prodi.nama_prodi, "Belum ada lokasi" as nama_lokasi, "Belum tersedia" as alamat_lokasi', false)
            ->join('dosen', 'dosen.id = kkn.dosen_id')
            ->join('prodi', 'prodi.id = kkn.prodi_id')
            ->where('kkn.lokasi_id', 0)
            ->findAll();

        $kkns = array_merge($kknsWithInstansi, $kknsWithoutInstansi);

        $mahasiswa = $this->mahasiswa->findAll();

        $kelompok_list = [];

        foreach ($kkns as $row) {
            $ketua_kelompok = $this->anggota->select('*')
                ->join('mahasiswa', 'mahasiswa.id = kkn_anggota.mahasiswa_id', 'left')
                ->where('kkn_anggota.kkn_id', $row['id'])
                ->where('kkn_anggota.is_ketua', true)
                ->first();
            $kelompok_list[] = [
                'id' => $row['id'],
                'nama_kelompok' => $row['nama_kelompok'],
                'tahun_akademik' => $row['tahun_akademik'],
                'tgl_mulai' => $row['tgl_mulai'],
                'tgl_selesai' => $row['tgl_selesai'],
                'nama_prodi' => $row['nama_prodi'],
                'nama_dosen' => $row['nama_dosen'],
                'nama_lokasi' => $row['nama_lokasi'],
                'alamat_lokasi' => $row['alamat_lokasi'],
                'nama_kepala_desa' => $row['nama_kepala_desa'],
                'no_kepala_desa' => $row['no_kepala_desa'],
                'ketua_kelompok' => ($ketua_kelompok) ? $ketua_kelompok['nama'] : 'Belum ada ketua',
            ];
        }
        $data = [
            'title' => 'Kelompok KKN',
            'kkns' => $kelompok_list,
            'mahasiswa' => $mahasiswa,
        ];

        return view('admin/kkn/index', $data);
    }


    public function create()
    {
        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();

        $prodiModel = new ProdiModel();
        $prodis = $prodiModel->findAll();


        $data = [
            'title' => 'Tambah KKN',
            'dosens' => $dosens,
            'prodis' => $prodis,
        ];

        return view('admin/kkn/create', $data);
    }

    public function store()
    {
        $kknModel = new KKNModel();

        $data = [
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
            'dosen_id' => $this->request->getPost('dosen_id'),
            'prodi_id' => $this->request->getPost('prodi_id'),
        ];

        $kknModel->insert($data);

        return redirect()->to('/admin/kkn')->with('success', 'Data KKN berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kknModel = new KKNModel();
        $kkn = $kknModel->find($id);

        $dosenModel = new DosenModel();
        $dosens = $dosenModel->findAll();

        $prodiModel = new ProdiModel();
        $prodis = $prodiModel->findAll();

        $data = [
            'title' => 'Edit KKN',
            'kkn' => $kkn,
            'dosens' => $dosens,
            'prodis' => $prodis,
        ];

        return view('admin/kkn/edit', $data);
    }


    public function update($id)
    {
        $kknModel = new KKNModel();

        $data = [
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
            'dosen_id' => $this->request->getPost('dosen_id'),
            'prodi_id' => $this->request->getPost('prodi_id'),
        ];

        $kknModel->update($id, $data);

        return redirect()->to('/admin/kkn')->with('success', 'Data KKN berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kknModel = new KKNModel();

        $kknModel->delete($id);

        return redirect()->to('/admin/kkn')->with('success', 'Data KKN berhasil dihapus.');
    }

    public function assignAnggota($kelompok_id)
    {
        $kkn = $this->kkn->find($kelompok_id);
        $mahasiswa = $this->mahasiswa
            ->select('mahasiswa.id as id, kkn_anggota.id as kkn_anggota_id, mahasiswa.nim, mahasiswa.nama',)
            ->join('kkn_anggota', 'mahasiswa.id = kkn_anggota.mahasiswa_id', 'left')
            // ->where('mahasiswa.prodi_id', $kkn['prodi_id'])
            ->whereNotIn('mahasiswa.id', function ($builder) use ($kelompok_id) {
                $builder->select('mahasiswa_id')
                    ->from('kkn_anggota')
                    ->where('kkn_id', $kelompok_id);
            })
            ->get()
            ->getResultArray();


        $rows = $this->anggota
            ->select('kkn_anggota.id as kkn_anggota_id, kkn.id as kkn_id, mahasiswa.id as mahasiswa_id, prodi.id as prodi_id, mahasiswa.*, kkn.*, prodi.*, kkn.*, kkn_anggota.*')
            ->where('kkn_id', $kelompok_id)
            ->join('kkn', 'kkn_anggota.kkn_id = kkn.id')
            ->join('mahasiswa', 'kkn_anggota.mahasiswa_id = mahasiswa.id')
            ->join('prodi', 'mahasiswa.prodi_id = prodi.id')
            ->get()
            ->getResultArray();

        $prodi = $this->prodi->find($kkn['prodi_id']);
        $dosen = $this->dosen->find($kkn['dosen_id']);

        $data = [
            'title' => 'Tambah Kelompok',
            'kelompok_id' => $kelompok_id,
            'kelompok' => $kkn['nama_kelompok'],
            'id_kelompok' => $kkn['id'],
            'prodi' => $prodi['nama_prodi'] ?? '-',
            'tgl_mulai' => $kkn['tgl_mulai'] ?? '-',
            'tgl_selesai' => $kkn['tgl_selesai'] ?? '-',
            'rows' => $rows,
            'mahasiswa' => $mahasiswa,
            'dospem' => $dosen['nama'] ?? '',
        ];

        return view('admin/kkn/assign_anggota', $data);
    }


    public function storeAnggota()
    {
        $kknAnggotaModel = new KKNAnggotaModel();

        $kkn_id = $this->request->getVar('kkn');
        $mahasiswa_id = $this->request->getVar('mahasiswa_id');

        $kknAnggotaModel->insert([
            'kkn_id' => $kkn_id,
            'mahasiswa_id' => $mahasiswa_id,
            'ketua' => false,
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan!');
        return redirect()->back()->with('success', 'Anggota KKN berhasil ditambahkan.');
    }

    public function deleteAnggota()
    {
        $kknAnggotaModel = new KKNAnggotaModel();
        $kknAnggotaModel->delete($this->request->getVar('id'));
        return redirect()->back()->with('success', 'Anggota KKN berhasil dihapus.');
    }


    public function statusAnggota()
    {
        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $kkn_id = $this->request->getVar('kkn_id');
        // Cek apakah status yang dipilih adalah "Ketua"
        if ($status == 'Ketua') {
            // Cari anggota dengan status "Ketua" selain anggota yang sedang diubah
            $existingKetua = $this->anggota->where('is_ketua', 1)->where('kkn_id', $kkn_id)->get()->getRow();
            // dd($kkn_id);
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
