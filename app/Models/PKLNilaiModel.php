<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLNilaiModel extends Model
{
    protected $table            = 'pkl_nilai_sidang';
    protected $primaryKey       = 'id_nilai';

    protected $allowedFields = [
        'mahasiswa_id',
        'pkl_id',
        'dosen_id',
        'sidang_id',
        'nilai_sikap',
        'nilai_penyajian_materi',
        'nilai_pendahuluan',
        'nilai_tinjauan_pustaka',
        'nilai_hasil_pembahasan',
        'nilai_kesimpulan_dan_saran',
        'nilai_daftar_pustaka',
        'nilai_argumentasi_penyaji',
        'nilai_penguasaan_materi',
        'catatan',
        'total_nilai',
        'nilai_mutu',
        'status_ujian',
    ];
}
