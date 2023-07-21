<?php

namespace App\Models;

use CodeIgniter\Model;

class PKLJadwalModel extends Model
{
    protected $table            = 'pkl_jadwal_sidang';
    protected $primaryKey       = 'id_pkl_jadwal_sidang';
    protected $allowedFields = [
        'tanggal',
        'keterangan',
        'dospeng_id',
        'tempat_id',
        'nilai_sikap', // Added new column
        'nilai_materi', // Added new column
        'nilai_pendahuluan', // Added new column
        'nilai_tinjauan_pustaka', // Added new column
        'nilai_pembahasan', // Added new column
        'nilai_kesimpulan', // Added new column
        'nilai_daftar_pustaka', // Added new column
        'nilai_argumentasi', // Added new column
        'nilai_penguasaan', // Added new column
        'total_nilai', // Added new column
        'komentar',
        'status',
        'mahasiswa_id',
    ];
    
}
