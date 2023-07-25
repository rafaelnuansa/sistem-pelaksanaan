<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\KKNJurnalMonitoringModel;
class KKNJurnalMonitoringController extends BaseController
{
    protected $jurnalModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->jurnalModel = new KKNJurnalMonitoringModel();
        $this->mahasiswaModel = new MahasiswaModel(); 
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaHasKKN();
        $data = [
            'mahasiswa' => $mahasiswa
        ];
    
        return view('admin/kkn/jurnal/monitoring/index', $data);
    } 

    public function show($id)
    {
        $jurnal = $this->jurnalModel->getJurnalMonitoringByIdMahasiswa($id);
        $mhs = $this->db->table('mahasiswa')->select('*')->where('id', $id)->get()->getRow();
        // dd($mhs);
        $data = [
            'title' => 'Jurnal Monitoring',
            'mahasiswa' => $mhs,
            'jurnals' => $jurnal
        ];
     
        return view('admin/kkn/jurnal/monitoring/show', $data);
    }
    

    public function create()
    {
        return view('admin/kkn/jurnal/monitoring/create');
    }

    public function store()
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
            'kkn_id' => $this->request->getPost('kkn_id'),
            'status' => $this->request->getPost('status'),
        ];

        $this->jurnalModel->insert($data);

        return redirect()->route('admin.jurnal.monitoring.index')->with('success', 'Data jurnal monitoring berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data = [
            'jurnal' => $this->jurnalModel->find($id),
        ];

        return view('admin/kkn/jurnal/monitoring/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
            'kkn_id' => $this->request->getPost('kkn_id'),
            'status' => $this->request->getPost('status'),
        ];

        $this->jurnalModel->update($id, $data);

        return redirect()->route('admin.jurnal.monitoring.index')->with('success', 'Data jurnal monitoring berhasil diupdate');

    }

    public function delete($id)
    {
        $this->jurnalModel->delete($id);
 
        return redirect()->route('admin.jurnal.monitoring.index')->with('success', 'Data jurnal monitoring berhasil dihapus');

    }
}
