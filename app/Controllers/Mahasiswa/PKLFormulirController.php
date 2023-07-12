<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;

class PKLFormulirController extends BaseController
{
 
    public function index()
    {
        $data = [
            'title' => 'Formulir Penilaian',
        ];
        
        return view('mahasiswa/pkl/formulir', $data);
    }
}
