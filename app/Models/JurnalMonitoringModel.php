<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalMonitoringModel extends Model
{
    protected $table            = 'jurnal_monitoring';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'hari',
        'nama_mhs',
        'keterangan'
    ];
}
