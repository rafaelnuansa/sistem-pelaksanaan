<?php

namespace App\Models;

use CodeIgniter\Model;

class TempatModel extends Model
{
    protected $table = 'tempat_sidang'; // Nama tabel di database
    protected $primaryKey = 'id_tempat'; // Primary key tabel

    protected $allowedFields = ['nama_tempat']; // Kolom yang diizinkan untuk diisi

    // Metode untuk mendapatkan semua data tempat
    public function getAll()
    {
        return $this->findAll();
    }

    // Metode untuk mendapatkan data tempat berdasarkan ID
    public function getById($id)
    {
        return $this->find($id);
    }

    // Metode untuk menyimpan data tempat baru
    public function create($data)
    {
        return $this->insert($data);
    }

    // Metode untuk memperbarui data tempat berdasarkan ID
    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    // Metode untuk menghapus data tempat berdasarkan ID
    public function deleteData($id)
    {
        return $this->delete($id);
    }
}
